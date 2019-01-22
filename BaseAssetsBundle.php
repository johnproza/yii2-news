<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 12.11.2018
 * Time: 13:20
 */

namespace oboom\news;
use yii\web\AssetBundle;

class BaseAssetsBundle extends AssetBundle
{
    public $sourcePath = '@vendor/johnproza/yii2-news/assets';
    public $css = [
        'css/style.css',
        'css/ionicons.min.css'
    ];
    public $js = [
        //'js/script.js',
        //'js/main.bundle.js'
    ];

    public $depends = [
        'yii\web\YiiAsset'
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}