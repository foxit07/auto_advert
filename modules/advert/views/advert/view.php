<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\advert\models\Advert */

$this->title = $advert['brand'] . ' ' . $advert['model'];
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $advert['id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $advert['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

   <div class="container">
       <div class="row">
           <div class="col-md-6 col-lg-6" >
               <?php if(!empty($advert['image'])): ?>
               <?= Html::img('/uploads/' .$advert['image']['0'], $options = ['class' => 'img-thumbnail', 'style' => ['width' => '720px', 'height' => '540']]); ?>
               <?php
                foreach ($advert['image'] as $image){
                    echo Html::img('/uploads/' .$image, $options = ['class' => 'img-thumbnail', 'style' => ['width' => '146px', 'height' => '106']]);
                }
               ?>
               <?php else: ?>
                    <h3>
                        Нет изображения
                    </h3>
               <?php endif ?>
           </div>
           <div class="col-md-6 col-lg-6" >
               <p>Бренд: <?= $advert['brand'] ?></p>
               <p>Модель: <?= $advert['model'] ?></p>
               <p>Опции:
                   <?php
                        foreach ($advert['options'] as $option){
                            echo $option . ' ';
                        }
                   ?>
               </p>
               <p>Цена: <?= $advert['price'] ?></p>
           </div>
       </div>
   </div>




    <?php /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'model_id',
            'mileage',
            'price',
            'phone',
        ],
    ])*/ ?>

</div>
