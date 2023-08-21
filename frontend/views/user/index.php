<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="user-index">

  
    <?php
    //Se activa si se registra una actualización en el AreasController.
     if(Yii::$app->session->hasFlash("ok_contraseña")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => "La contraseña del usuario ". $_SESSION['user']. " ha sido cambiada con exito. "]);
        ?>
    <?php endif; ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

       <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Usuarios</h3>',
        'type'=>'primary',
        
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],
          'exportConfig'=>[
        GridView::PDF=>['label'=>'Exportar como PDF',

        ]], 
        /*'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'username',
            'label' => 'Nombre de Usuario',
            
            ],
           /* [
             'attribute'=>'email',
            'label' => 'Correo',   
            ],*/
              [
             'attribute'=>'direccionid',
            'label' => 'Dirección',
            'value'=> function ($model){
            return $model->direccion->nombre;
            },
             'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\Direccion::find()->where(['status'=>1])->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione la Direción'],
            
            ],
            [
            'attribute'=>'conectado',
            'label' => 'Conectado',
             'format'=>'raw',
            'value'=>  function ($model){
             return             $model->conectado ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>' ;
            },
                       'filterType'=>GridView::FILTER_SELECT2,   
                       'filter'=>[
                           0=>'no',
                           1=>'si',
                       ], 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                 'filterInputOptions'=>['placeholder'=>'Estado'],
                
            ],
           
            ['class' => 'yii\grid\ActionColumn',
              'template' => '{view} {password} {desconectar} {permisos}',
                 'buttons' => [
                     'password' => function ($url, $model){
               
                        return Html::a(
                                 ' &nbsp<span class = "glyphicon glyphicon-lock" stytle ="right:15px"></span',
                                 $url, 
                                 [
                                   'title' => 'Cambiar contraseña ',
                                  
                                 ]
                                 ); 
              
                          },
                                  'desconectar' => function ($url, $model){
               
                        return Html::a(
                                 ' &nbsp<span class = "glyphicon glyphicon-remove-sign" stytle ="right:5px"></span',
                                 $url, 
                                 [
                                   'title' => 'Desconectar Usuario ',
                                  
                                 ]
                                 ); 
              
                          },
                                   'permisos' => function ($url, $model){
               
                        return Html::a(
                                 ' &nbsp<span class = "glyphicon glyphicon-check" stytle ="right:5px"></span',
                                 Url::toRoute(['rbac/assignment/view', 'id' => $model->id]),
                                 [
                                   'title' => 'Asignar Permisos ',
                                  
                                 ]
                                 ); 
              
                          },
                ],
        ],
                                  ],
    ]); 
      ?>
</div>
