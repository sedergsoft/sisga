<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
$this->title = $name;
$this->params['tittle'][]= $this->title;
?>

     <section id="error" class="container"  style="margin-top: 0px;">
        <h1> Error al conectar, Usuario Conectado</h1>
        
       
     <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
        <?= Html::a('<i class="glyphicon glyphicon-home"></i> VOLVER AL INICIO', ['site/index'], ['class' => 'btn btn-success'])?>
        <?= Html::a('<i class="glyphicon glyphicon-refresh"></i> RECUPERAR USUARIO', ['site/recuperar'], ['class' => 'btn btn-danger'])?>
       
    </section><!--/#error-->
 
