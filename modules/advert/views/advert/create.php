<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $brands array app\modules\advert\models\Brand */
/* @var $advert app\modules\advert\models\Advert */
/* @var $brand app\modules\advert\models\Brand */
/* @var $options app\modules\advert\models\Option*/
/* @var $image app\modules\advert\models\Image*/

$this->title = 'Create Advert';
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'advert' => $advert,
        'brand' => $brand,
        'brands' => $brands,
        'options' => $options,
        'models' => $models,
        'image' => $image
    ]) ?>

</div>
