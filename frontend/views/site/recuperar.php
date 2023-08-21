<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Recuperar Usuario';
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="site-contact">
    <p>
        Introduzca su nombre de Usuario
    </p>

     <?php if(Yii::$app->session->hasFlash("sinpreguntas")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "Su usuario no se puede recuperar porque usted no definio las preguntas de control. Para recuperar su usuario contacte con el administrador del sistema."]);
        ?>
    
    <?php endif; ?> 
     <?php if(Yii::$app->session->hasFlash("usuario_error")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-info'], 'body' => "Su usuario no se encuentra conectado."]);
        ?>
    
    <?php endif; ?> 
    
     <?php if(Yii::$app->session->hasFlash("error_respuestas")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "Sus respuestas no coinciden con las que definio previamente. Por favor verifique que es el usuario correcto"]);
        ?>
    
    <?php endif; ?> 
    
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'user')->textInput(['autofocus' => true]) ?>

               

                <div class="form-group">
                    <?= Html::submitButton('Recuperar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
