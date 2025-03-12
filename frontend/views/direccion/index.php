<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DireccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Entiades');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
$this->params['desc'][]= "Entidades que componen el grupo";
?>
<div class="direccion-index">
   

       
    <?php 
    
    
    if(Yii::$app->user->identity->rolid == "2")
     {
     
     
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Entidades</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],/*
        'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'nombre',
            'label' => 'Nombre',
            
            ],
            [
            'attribute'=>'responsable',
            'label' => 'Responsable',
            
            ],
           
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                ],
        ],
    ]); 
    
     }else{
         
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Entidades</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
       // 'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],/*
        'toolbar'=>[
        '{toggleData}'
    ],*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'nombre',
            'label' => 'Nombre',
            
            ],
            [
            'attribute'=>'responsable',
            'label' => 'Responsable',
            
            ],
           
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                ],
        ],
    ]); 
    
         
         
     }

        
    ?>    
</div>
