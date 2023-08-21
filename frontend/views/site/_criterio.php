  <?php
  use kartik\grid\GridView;
  
  
  
  
  ?>
<div>   
 <?= GridView::widget([
        'dataProvider' => $dataProviderCriterio,
        'filterModel' => $searchModelCriterio,
        'pjax'=>true,
        'columns' => [
           

            //'id_trabajador',
            [
             'attribute'=>'orden', 
             'label'=>'criterio',
             'value'=> function ($model){
        return frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->id);
            
             }
            ],
            'Descripcion',
            'UM',
            
             [
               'attribute'=>'tope.Itrimestre',
                 'label'=>'I',
                'value'=> function ($model){
                    return $model->tope->Itrimestre;
                }, 
            ],
            [
               'attribute'=>'tope.IItrimestre',
                'label'=>'II',
                'value'=> function ($model){
                    return $model->tope->IItrimestre;
                }, 
            ],
                        [
               'attribute'=>'tope.IItrimestre',
                'label'=>'III',
                'value'=> function ($model){
                    return $model->tope->IIItrimestre;
                }, 
            ],
                        [
               'attribute'=>'tope.IVtrimestre',
                            'label'=>'IV',
                'value'=> function ($model){
                    return $model->tope->IVtrimestre;
                }, 
            ],
            [
               'attribute'=>'direccionid',
                'value'=> function ($model){
                    return $model->direccion->nombre;
                }, 
            ],
           
         
        ],
    ]); ?>
</div>
<div>   
 <?= GridView::widget([
        'dataProvider' => $dataProviderIndicador,
        'filterModel' => $searchModelIndicador,
        'pjax'=>true,
        'columns' => [
           
            

            [
            'attribute'=>'orden',
            'label' => 'Número',
            'value'=> function ($model)
             {
              return 'Ind. '.frontend\controllers\IndicadoresgestionController::buscarOrdenGeneral($model->id);
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