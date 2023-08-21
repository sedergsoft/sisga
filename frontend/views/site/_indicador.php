 <?php
  use kartik\grid\GridView;
  
  
  
  
  ?>
<div>   
 <?= GridView::widget([
        'dataProvider' => $dataProviderIndicador,
        'filterModel' => $searchModelIndicador,
        'pjax'=>true,
        'columns' => [
           
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return frontend\controllers\IndicadoresgestionController::buscarOrdenGeneral($model->id);
             }
            
            ],
            
            [
            'attribute'=>'descripcion',
            'label' => 'Descripcion',
            
            ],
            [
             'attribute'=>'UM',
            'label' => 'Unidad de Medida',   
            ],
              
             [
            'attribute'=>'direccion.nombre',
            'label' => 'Dirección que lo tributa',
            
            ],
            [
            'attribute'=>'fecha_chequeo',
            'label' => 'Fecha de Chequeo',
            
            ],
                    [
            'attribute'=>'idtope',
            'label' => 'Planificado',
             'value'=> function ($model)
            {
                 return $model->tope->sentido->sentido.$model->tope->valor;
            }
             
            ],
           
          
        ],
    ]); ?>

</div>