<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\advert\models\Brand;
use app\modules\advert\assets\AdvAsset;

AdvAsset::register($this);
/* @var $this yii\web\View */
/* @var $advert app\modules\advert\models\Advert */
/* @var $brand app\modules\advert\models\Brand */
/* @var $options app\modules\advert\models\Option*/
/* @var $image app\modules\advert\models\Image*/

/* @var $form yii\widgets\ActiveForm */
?>

<div class="advert-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($brand, 'id')->dropDownList($brands)->label('Brands') ?>

    <?= $form->field($advert, 'model_id')->dropDownList($models )->label('Model') ?>

    <?= $form->field($options, 'name')
        ->checkboxList(ArrayHelper::map($options->find()->all(),'id','name'));
    ?>

    <?= $form->field($advert, 'mileage')->textInput() ?>

    <?= $form->field($advert, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($advert, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($image, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
