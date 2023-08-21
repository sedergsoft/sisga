<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Autenticarme';
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;

?>

<div  class="site-login">
    
     <?php if(Yii::$app->session->hasFlash("usuario_desconectado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => "Su usuario ya a sido liberado, ahora puede loguearse.."]);
        ?>
    <?php endif; ?> 
    
    <p align = "center">Por favor llene todos los campos para autenticarse:</p>

     <hr>
     <br>
    <div  align= "center" class="container centered">
        <div class="col-lg-5 col-sm-5 col-md-5 center" style="float: inherit">
            <?php $form = ActiveForm::begin(['id' => 'login-form',
                                            'class'=>'center',
                'fieldConfig' => [
                'template' => "{input}{error}"]
                
                ]); ?>
            <fieldset class="registration-form">
                <?= $form->field($model, 'username', [
                                                        'addon' => [
                                                                    'prepend' => [
                                                                                 'content' => '<i class="glyphicon glyphicon-user"></i>'
                                                                                 ]
                                                                    ]])->textInput(['autofocus' => true,
                    'placeholder'=>'Usuario'
                    ]) ?>

                
                <?= $form->field($model, 'password', [
                                                        'addon' => [
                                                                    'prepend' => [
                                                                                 'content' => '<i class="glyphicon glyphicon-lock"></i>'
                                                                                 ]
                                                                    ]
                                                        ])->passwordInput(['placeholder'=>'Contraseña']);?>

               

             

                <div class="form-group">
                    <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                </fieldset>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
     <!--
     <section id="registration" class="container">
        <form class="center" role="form">
            <fieldset class="registration-form">
                <div class="form-group">
                    <input type="text" id="username" name="username" placeholder="Username" class="form-control">
                </div>
              
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                </div>
               
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-md btn-block">Entrar</button>
                </div>
            </fieldset>
        </form>
    </section>-->
</div>
