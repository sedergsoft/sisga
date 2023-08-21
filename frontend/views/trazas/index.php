<?php

//use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TrazasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Trazas');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="trazas-index">

   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-random"></i>   Trazas </h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
              [
             'attribute'=>'IdUsuario',
                'label'=>'Usuario',
                'value'=> function ($model)
                  {
        
             return frontend\controllers\UserController::findModel([$model->IdUsuario])->username;   
            
                },
                /*'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(frontend\models\User::find()->where(['status'=>10])->orderBy('id')->asArray()->all(), 'id', 'username'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Selecione el Usuario..'],
              */
           ],
            'tarea_realizada',
            
            [
                'attribute'=>'Tabla_Afectada',
                'label'=>'Datos',
                //'value' =>
                
                ],
                  
            [
                'attribute'=>'valor_antiguo',
                'label'=>'ID Información Anterior',
                
                ],
                    
            [
                'attribute'=>'valor_actual',
                'label'=>'ID Información Actual',
                
                ],
                   
          'fecha',
           //'criteriomedidaid',
            //'estado',
            //'periodo',
            //'userid',
            //'observaciones:ntext',

            ['class' => 'yii\grid\ActionColumn',
                              
       'template' => '{view}',
             ] ,
        ],
    ]); ?>

   
</div>
