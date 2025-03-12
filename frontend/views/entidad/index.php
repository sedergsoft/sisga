<?php

use frontend\models\Entidad;
use frontend\models\Provincia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EntidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Entidad');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="entidad-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'filterModel' => $searchModel,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Entidades</h3>',
            'type'=>'primary',
            // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
            //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            //'footer'=>false
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //  'id',
            'nombre',
            'nombre_corto',
            [
                'attribute'=>'provincia_id',
               'label' => 'Provincia', 
               'value'=> function ($model)
                {
                 return $model->provincia->provincia;
                   
                },
                 'filterType'=>GridView::FILTER_SELECT2,
                   'filter'=>ArrayHelper::map(Provincia::find()->orderBy('id')->asArray()->all(), 'id', 'provincia'), 
                   'filterWidgetOptions'=>[
                       'pluginOptions'=>['allowClear'=>true],
                   ],
                   'filterInputOptions'=>['placeholder'=>'Selecione la Provincia..'],
                   
                
                ],
            [
                'attribute'=>'superiorid',
               'value'=> function ($model)
                {
                 return $model->superiorid?$model->entidad->nombre_corto:"";
                   
                },
                 'filterType'=>GridView::FILTER_SELECT2,
                   'filter'=>ArrayHelper::map(Entidad::find()->orderBy('id')->asArray()->all(), 'id', 'nombre'), 
                   'filterWidgetOptions'=>[
                       'pluginOptions'=>['allowClear'=>true],
                   ],
                   'filterInputOptions'=>['placeholder'=>'Selecione entidad..'],
                   
                
                ],
        
           // 'superiorid',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
