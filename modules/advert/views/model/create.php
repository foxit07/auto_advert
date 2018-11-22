<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\advert\models\Model */
/* @var $brands app\modules\advert\models\Brand */

$this->title = 'Create Model';
$this->params['breadcrumbs'][] = ['label' => 'Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'brands' => $brands,
    ]) ?>

</div>
