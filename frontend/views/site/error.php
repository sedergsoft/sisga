<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['tittle'][]= $this->title;
?>

     <section id="error" class="container"  style="margin-top: 0px;">
        <h1>Página no disponible</h1>
        
        <p>La página que ha solicitado no esta disponible o ha ocurrido un error.</p>
     <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
        <?= Html::a('<i class="glyphicon glyphicon-home"></i> VOLVER AL INICIO', ['site/index'], ['class' => 'btn btn-success'])?>
       
    </section><!--/#error-->
 
