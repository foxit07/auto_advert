<?php
/**
 * Created by PhpStorm.
 * User: David Arakelyan
 * Email: rotokan2@gmail.com
 * Date: 20.11.2018
 * Time: 9:57
 */
namespace app\modules\advert\assets;
use app\assets\AppAsset;
use yii\web\AssetBundle;

class AdvAsset extends AssetBundle
{
    public $sourcePath = __DIR__;

    public $js = [
        'resources/js/scripts.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}