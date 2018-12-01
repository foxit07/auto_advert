<?php

namespace app\modules\advert\models;

use Yii;

use yii\db\Query;
use app\modules\advert\components\UploadFileBehavior;
use yii\web\UploadedFile;


/**
 * This is the model class for table "adverts".
 *
 * @property int $id
 * @property int $model_id
 * @property int $mileage
 * @property string $price
 * @property string $phone
 */
class Advert extends \yii\db\ActiveRecord
{

    public $brand;
    public $model;
    public $opt;
    public $images;
    public $option;

    const SCENARIO_CREATE = 'create';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adverts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'price', 'phone', 'mileage', 'brand', 'model_id', 'option'], 'required'],
            [['price', 'phone'], 'string', 'max' => 255],
            [['mileage'], 'integer'],
            [['images'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxFiles' => 3, 'maxSize' => 2*1024*1024],
            [['status'], 'default', 'value' => 1 ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
       return Image::find()->where(['advert_id' => $this->id])->all();
    }

    public function getModel()
    {
        return Model::find()->where(['id' => $this->model_id])->one();
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Option::className(),['id' => 'option_id'])->viaTable('adverts_options', ['advert_id' => 'id']);
    }

    /**
     * @param null $object
     * @return int
     * @throws \yii\db\Exception
     */
    public function destroyOptions($object = null)
    {
        if ($object === null) $object = $this;
        return Yii::$app->db->createCommand()->delete('adverts_options', "advert_id = $object->id")->execute();
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_id' => 'Model ID',
            'mileage' => 'Mileage',
            'price' => 'Price',
            'phone' => 'Phone',
        ];
    }

    public function behaviors()
    {
        return[
             [
                'class' => 'app\modules\advert\components\StorageBehavior',
                'fileImages' => 'images',
                 'width' => 720,
                 'height' => 520,
            ]];

    }

    public function saveA()
    {
        $this->save();
        $query = new Query();

        foreach ($this->path as $path){
            $image = new Image();
            $image->advert_id = $this->id;
            $image->path = $path;
            $image->save();
        }

        foreach($this->option as $value) {
            $query->createCommand()->insert('adverts_options', [
                'advert_id' => $this->id,
                'option_id' => $value,
            ])->execute();
        }

        return true;
    }

    public function updateA()
    {
        $this->save();
        $query = new Query();
        if(!empty($this->path)) {
            $images = Image::findAll(['advert_id' => $this->id]);

            $i = 0;
            if(count($images) > count($this->path)){
                foreach ($images as $key => $img) {
                    $img->delete();
                    if (count($images) - $i == count($this->path)) exit;
                }
            }
            foreach ($this->path as $key => $path){
                if(!empty($images[$key])) {
                    $images[$key]->path = $path;
                    $images[$key]->advert_id = $this->id;
                    $images[$key]->save();
                }else{
                    $images = new Image();
                    $images->path = $path;
                    $images->advert_id = $this->id;
                    $images->save();
                }
            }

        }

        $this->destroyOptions();
        foreach($this->option as $value) {
            $query->createCommand()->insert('adverts_options', [
                'advert_id' => $this->id,
                'option_id' => $value,
            ])->execute();
        }

        return true;
    }

    public function deleteA()
    {
        $this->destroyOptions();
        $this->delete();
        Image::deleteAll(['advert_id' => $this->id]);
    }
}
