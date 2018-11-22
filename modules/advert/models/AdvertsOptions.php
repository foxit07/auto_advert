<?php

namespace app\modules\advert\models;

use Yii;

/**
 * This is the model class for table "adverts_options".
 *
 * @property int $id
 * @property int $advert_id
 * @property int $option_id
 */
class AdvertsOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adverts_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['advert_id', 'option_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'advert_id' => 'Advert ID',
            'option_id' => 'Option ID',
        ];
    }
}
