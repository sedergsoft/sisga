<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use kartik\popover\PopoverX;
use kartik\form\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EvaluacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Evaluación de los criterios de medida');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;

?>
<div class="evaluacion-index">
  
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <?php
    //Se activa si se registra una actualización en el AreasController.
     if(Yii::$app->session->hasFlash("ok_certificado")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-success'], 'body' => "La información del Criterio de medida ".Yii::$app->session->getFlash("ok_certificado"). " ha sido certificada por usted correctamente."]);
        ?>
    <?php endif; ?>
   
 <?php
    //Se activa si se registra un error de autenticacion.
     if(Yii::$app->session->hasFlash("Error_autenticacion")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "<h4><strong> Información no accesible!!!</strong></h4><br>Debe autenticarse para poder ver los detalles de la evaluación. <br><br><div class = 'right'><a  href='/sisga/frontend/web/index.php/site/login' class='btn btn-danger' <i class='glyphicon glyphicon-user'></i> Login </a></div> "]);
        ?>
    <?php endif; ?>
   
   <hr>
    <p>
            <?php  PopoverX::begin([
    'placement' => PopoverX::ALIGN_AUTO,
    'toggleButton' => ['label'=>'<i class="glyphicon glyphicon-calendar"></i> Selecionar Periodo', 'class'=>'btn btn-success'],
    'header' => '<i class="glyphicon glyphicon-calendar"></i> Selecione el periodo a mostrar',
    'footer' => Html::button('<i class="glyphicon glyphicon-ok"></i>', [
            'class' => 'btn btn-sm btn-primary', 
            'onclick' => '$("#kv-login-form").trigger("submit")',
           'value'=> Url::to(['evaluacion/selecionarmes'])
        ]) 
]);
// form with an id used for action buttons in footer
$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false],'action'=>"/sisga/frontend/web/index.php/evaluacion/selecionarmes", 'options' => ['id'=>'kv-login-form']]);
 echo Select2::widget([
    'name' => 'Mes',
    'data' =>  [
                1 => 'I Trimestre', 
                2 => 'II Trimestre',
              3 => 'III Trimestre', 
                4 => 'IV Trimestre',
              ],
    'options' => ['placeholder' => 'Seleciona el periodo a mostrar ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);?>
 
        <br>
        
 <?php echo \kartik\touchspin\TouchSpin::widget([
    'name' => 'Año',
          
             'options' =>[
                            'class'=>'input-sm',
                            //'placeholder'=>'2019',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'Año :',
                                    'initval'=> date('Y'),
                                    'min'=>2018,
                                    'max'=>2050,
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
        
    ]      
]);
//echo $form->field($model, 'password')->passwordInput(['placeholder'=>'Enter password...']);
ActiveForm::end();
PopoverX::end();
?>
    </p>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Evaluación de los Criterios medidas </h3>',
        'type'=>'primary',
        //'before'=>Html::button('<i class="glyphicon glyphicon-calendar"></i> Seleccionar mes ', ['value'=> Url::to(['evaluacion/selecionarmes']),'class' => 'btn btn-success','id'=>'modalButton']),
       // 'before'=>Html::a('<i class="glyphicon glyphicon-calendar"></i> Seleccionar mes ', ['selecionarmes'], ['class' => 'btn btn-success']),
        //'before'=> 'Datos correspondientes al mes: '. $dataProvider->fechacreado,
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    
            //popover
  
            
            
            //popover
            ],
        'columns' => [
        //    ['class' => 'yii\grid\SerialColumn'],
   
     [
    'attribute'=>'criteriomediada[id]',
    'label'=>'Criterio',
    'value'=> function ($model)
    {
     return frontend\controllers\CriteriomedidaController:: buscarOrdenGeneral($model->criteriomedida->id);  
    }
    ],        
            
    [
    'attribute'=>'criteriomediada[id]',
    'label'=>'Criterio de Mediada',
    'value'=> function ($model)
    {
     return $model->criteriomedida->Descripcion;   
    }
    
    ],
            [
             'attribute'=>'valor_vreal',
             'label'=>'Valor Actual'
            ],
            [ 
                'attribute'=>'fechacreado',
                'label' => 'Fecha de Actualización'
             ],
            [
              'attribute'=> 'direccionid',
                'label'=>'Informa',
                'value'=>function($model)
    {
        return $model->direccion->nombre;
    }          ],
            [
               'attribute'=>'Estado',
                'label'=>'Estado',
                'value'=> function($model)
                {
                return $model->estado0->estado;
                }
            ],
            /*'valor_vreal',
            'fechacreado',
            'direccionid',
            'criteriomedidaid',*/
            

            ['class' => 'yii\grid\ActionColumn',
                              
       'template' => '{view} {certificar}',
           /*  'buttons' => [
                     'view' => function ($url, $data){
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-eye-open" style="right: 0px";></span>',
                                                                            $url = Url::toRoute(['evaluacion/view', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Ver ',
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                    'certificar' => function ($url, $data){
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-ok" style="right: -10px";></span',
                                                                            $url = Url::toRoute(['evaluacion/certificar', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Certificar Información ',
                                                                                 'data-confirm'=> 'Esta seguro que desea certificar esta información'
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                ],*/] ,
        ],
    ]); ?>

</div>
