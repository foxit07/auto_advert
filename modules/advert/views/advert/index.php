<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use Yii;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $data array mixed (Advert, Image, Options, Brand, Model) */
/* @var  $pages yii\data\Pagination*/

$this->title = 'Adverts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Advert', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php foreach ($data as $advert): ?>

    <div class="panel panel-default" >

        <div class="panel-body" >
            <div style="display: inline-block">
                <?= Html::img('/uploads/' .$advert['image'], $options = ['class' => 'img-thumbnail', 'style' => ['width' => '146px', 'height' => '106']]); ?>
               <h3 style="display: inline-block";>
                <?= Html::a($advert['brand'] . '  '. $advert['model'], ['advert/view', 'id' => $advert['id']], ['class' => 'profile-link']) ?>
               </h3>
            <h4 style="display: inline-block">
                <?= Yii::$app->formatter->asCurrency($advert['price']) ?>
            </h4>

            <?= Html::beginForm(['advert/delete', 'id' => $advert['id']], 'post', ['style' => 'display: inline-block']) ?>
            <?= Html::submitButton('Delete', ['class' => 'btn btn-warning']) ?>
            <?= Html::endForm() ?>
        </div>
        </div>
    </div>

    <?php endforeach; ?>

</div>

<?= LinkPager::widget([
    'pagination' =>  $pages,
]);
?>
