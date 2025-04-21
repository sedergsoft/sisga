<?php

use frontend\models\TipoSelReserva;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReservaCuadroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reservas de Cuadros');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="reserva-cuadro-index">

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'filterModel' => $searchModel,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> '.$this->title.'</h3>',
            'type'=>'primary',
            // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
          //  'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
            //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            //'footer'=>false
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'status',
           [
            'attribute'=>'cuadroid',
            'value'=>function($model)
            {
                return Html::encode(ucwords($model->cuadro->personaCI0->nombrecompleto()));
            },
            'group' => true,
           ],
           [
            'attribute'=>'reservaid',
            'value'=>function($model)
            {
                return Html::encode(ucwords($model->reserva->personaCI0->nombrecompleto()));
            },
        ],
            [
                'attribute'=>'tipo_sel_reservaid',
               
                'value'=>function($model)
                {
                    return Html::encode(ucwords($model->tipoSelReserva->tipo));
                },
                'filterType'=>GridView::FILTER_SELECT2,   
                           'filter'=>ArrayHelper::map(TipoSelReserva::find()->andFilterWhere(['status'=>1])->all(),'id','tipo')
                           , 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                     'filterInputOptions'=>['placeholder'=>'Seleccionee..'],
                
            ],
          
         
           

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view}  {delete}',
             'buttons'=>[
                            
                'view'=> function($url,$data)
                                        {
                                       
                                                            return Html::a(
                                                                            '<i class = "glyphicon glyphicon-eye-open";></i>',
                                                                            $url = Url::toRoute(['view', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                'class'=>'btn btn-primary btn-xs', 
                                                                                'title' => 'Ver Reserva ',
                                                                                 
                                                                             ]
                                                                            );    
                                                           },
                                                           'delete'=> function($url,$model)
                                                           {
                                                          
                                                                               return Html::a(
                                                                                               '<i class = "glyphicon glyphicon-trash"></i>',
                                                                                               $url = Url::toRoute(['delete','id' => $model->id]),
                                                                                               
                                                                                                
                                                                                                    
                                                                                                    [
                                                                                                      'title'=> 'Eliminar reserva',
                                                                                                      'class'=>'btn btn-danger btn-xs', 
                                                                                                  'data' => [
                                                                                                   'confirm' => Yii::t('app', 'Esta seguro que desea Eliminar esta reserva.'),
                                                                                                   'method' => 'post',
                                                                                               ],]
                                                                                                  
                                                                                               
                                                                                               );    
                                                                              },
               
                ],    
                                        
                        ] 
        ],
    ]); ?>
</div>
