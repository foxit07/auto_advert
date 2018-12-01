<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $brands array app\modules\advert\models\Brand */
/* @var $advert app\modules\advert\models\Advert */
/* @var $options app\modules\advert\models\Option*/


$this->title = 'Create Advert';
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'advert' => $advert,
        'brands' => $brands,
        'models' => $models,
        'options' => $options,
    ]) ?>

</div>
