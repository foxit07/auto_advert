<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\advert\models\Model */
/* @var $form yii\widgets\ActiveForm */
/* @var $brands app\modules\advert\models\Brand */


?>

<div class="model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(!empty($brands)) {
        echo $form->field($model, 'brand_id')->dropDownList($brands)->label('Brands');
    }else{
        echo $form->field($model->brand, 'name')->textInput(['maxlength' => true]);
    }
    ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
