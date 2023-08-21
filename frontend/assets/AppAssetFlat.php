<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAssetFlat extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $sourcePath ='@bower/flat/';
    public $css = [
        'css/site.css',
        'css/bootstrap_flat.min.css',
        'css/font-awesome_flat.min.css',
        'css/prettyPhoto_flat.css',
        'css/animate_flat.css',
        'css/main_flat.css',
             
        
    ];
    public $js = [
        'js/jquery_flat.js',
        'js/bootstrap_flat.min.js',
        'js/jquery_flat.prettyPhoto.js',
        'js/main_flat.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
       'yii\bootstrap\BootstrapAsset',
    ];
}
