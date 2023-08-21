<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Nuevo Usuario';
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="site-signup ">
   

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>
               
                <?= $form->field($model, 'direccion')->widget(kartik\select2\Select2::className(),[
                     'data'=> yii\helpers\ArrayHelper::map(frontend\models\Direccion::find()->all(), 'id', 'nombre'),
        'pluginOptions'=>['placeholder'=>'Selecione la direcion a la que pertenece..'],
   
                ]) ?>
            
             <?= $form->field($model, 'rol')->widget(kartik\select2\Select2::className(),[
                     'data'=> yii\helpers\ArrayHelper::map( backend\models\Rol::find()->all(), 'id', 'rol'),
        'pluginOptions'=>['placeholder'=>'Selecione el tipo de usuario..'],
   
                ]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Crear', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
