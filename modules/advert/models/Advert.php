<?php

namespace app\modules\advert\models;

use Yii;

use yii\db\Query;


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
            [['model_id', 'mileage'], 'integer'],
            [['price', 'phone'], 'string', 'max' => 255],
            [['mileage'], 'required'],
            [['price'], 'required'],
            [['phone'], 'required'],
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
       return $this->hasMany(Image::className(),['advert_id' => 'id']);
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Option::className(),['id' => 'option_id'])->viaTable('adverts_options', ['advert_id' => 'id']);
    }

    /**
     * @param $data
     * @param null $command
     * @return bool
     * @throws \yii\db\Exception
     */
    public function saveAll($data, $command = null)
    {
        if($command === 'update'){
            $this->destroyOptions();
        }
        $this->save();
        $image = new Image();
        $image->saveImage($this);

        $options = $data['Option'];
        $query = new Query();

        foreach($options['name'] as $option) {
            $query->createCommand()->insert('adverts_options', [
                'advert_id' => $this->id,
                'option_id' => $option,
            ])->execute();
		}
        return true;
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
}
