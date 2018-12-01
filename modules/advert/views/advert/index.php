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

    <?php foreach ($models as $advert): ?>

    <div class="panel panel-default" >

        <div class="panel-body" >
            <div style="display: inline-block">
                <?php if(!empty($advert->getImages()[0])): ?>
                <?= Html::img('/uploads/' .$advert->getImages()[0]->path, $options = ['class' => 'img-thumbnail', 'style' => ['width' => '146px', 'height' => '106']]); ?>
               <?php else: ?>
               <?php echo 'Нет картинки' ?>
               <?php endif; ?>
               <h3 style="display: inline-block";>
                <?= Html::a($advert->getModel()->brand->name . '  '. $advert->getModel()->name, ['advert/view', 'id' => $advert->id, ['class' => 'profile-link']]) ?>
               </h3>
            <h4 style="display: inline-block">
                <?= Yii::$app->formatter->asCurrency($advert->price) ?>
            </h4>
        <div style="display: inline-block">
            <?= Html::beginForm(['advert/delete', 'id' => $advert->id, 'post', ['style' => 'display: inline-block']]) ?>
            <?= Html::submitButton('Delete', ['class' => 'btn btn-warning', 'style' => 'display: inline-block']) ?>
            <?= Html::endForm() ?>
        </div>
        </div>
        </div>
    </div>

    <?php endforeach; ?>

</div>

<?= LinkPager::widget([
    'pagination' =>  $pages,
]);
?>
