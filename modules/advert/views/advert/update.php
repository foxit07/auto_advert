<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $brands array app\modules\advert\models\Brand */
/* @var $advert app\modules\advert\models\Advert */
/* @var $brand app\modules\advert\models\Brand */
/* @var $options app\modules\advert\models\Option*/
/* @var $image app\modules\advert\models\Image*/


$this->title = 'Update Advert: ' . $advert->id;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $advert->id, 'url' => ['view', 'id' => $advert->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="advert-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'advert' => $advert,
        'brand' => $brand,
        'model' => $model,
        'option' => $option,
    ]) ?>

</div>
