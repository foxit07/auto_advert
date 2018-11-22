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
/* @var $model app\modules\advert\models\Model*/
/* @var $form yii\widgets\ActiveForm */
?>

<?php
/*echo '<pre>';
print_r($brands);
die;*/
?>
<?php
/*echo '<pre>';
print_r(ArrayHelper::map($options->find()->all(),'id','name'));
print_r($checkedOptions );

die;*/

?>

<div class="advert-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($brand, 'id')->dropDownList($brands, ['options' =>[ $brand->name => ['Selected' => true]]])->label('Brands') ?>

    <?= $form->field($advert, 'model_id')->dropDownList([$model->id => $model->name])->label('Model') ?>

    <?= $form->field($options, 'name')->checkboxList(ArrayHelper::map($options->find()->all(),'id','name'))->label(''); ?>

    <?= $form->field($advert, 'mileage')->textInput() ?>

    <?= $form->field($advert, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($advert, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($image, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

   <?php if(!empty($advert->images)){
            foreach ($advert->images as $image) {
                echo Html::img('/uploads/' .$image->path, $options = ['class' => 'img-thumbnail', 'style' => ['width' => '146px', 'height' => '106']]);
            }
        }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
