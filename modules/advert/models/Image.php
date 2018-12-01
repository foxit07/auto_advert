<?php

namespace app\modules\advert\models;

use Yii;
use yii\web\UploadedFile;
use app\modules\advert\components\StorageBehavior;
use app\modules\advert\models\Advert;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $path
 * @property int $advert_id
 */
class Image extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg','maxFiles' => 3],
        ];
    }

    public function getAdvert()
    {
        return $this->hasOne(Advert::className(), ['id' => 'advert_id']);
    }

    public function setImages()
    {
        $this->image = UploadedFile::getInstances($this, 'image');
    }

    public function uploadImages()
    {
        $storage = new StorageBehavior();
        $this->setImages();

        if($this->image){
            foreach ($this->image as $img) {
                $path[] = $storage->saveUploadedFile($img);
            }
            return $path;
        }
        return false;
    }

    public function saveImage(Advert $advert)
    {
        $this->deleteImage($advert);

        if($paths = $this->uploadImages()) {

            echo '<pre>';

            foreach ($paths as $path) {
                $img = new self;
                $img->path = $path;
                $img->advert_id = $advert->id;
                $img->save(false);
            }
        }
    }

    public function deleteImage($obj)
    {
        $images = self::find()->where(['advert_id' => $obj->id])->all();
        $storage = new StorageBehavior();

        if($images){
            foreach ($images as $image){
                $storage->deleteFile($image['path']);
            }
            Yii::$app->db->createCommand()->delete('images', "advert_id = $obj->id")->execute();
        }

    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'advert_id' => 'Advert ID',
        ];
    }
}
