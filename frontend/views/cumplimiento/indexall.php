<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\popover\PopoverX;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Alert;
//use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CumplimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Evaluación de los Indicadores de Gestión');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="cumplimiento-index">
    <?php
     if(Yii::$app->session->hasFlash("Error_autenticacion")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => "<h4><strong> Información no accesible!!!</strong></h4><br>Debe autenticarse para poder ver los detalles de la evaluación. <br><br><div class = 'right'><a  href='/sisga/frontend/web/index.php/site/login' class='btn btn-danger' <i class='glyphicon glyphicon-user'></i> Login </a></div> "]);
        ?>
    <?php endif; ?>
    
 <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
     <hr>
    <p>
            <?php  PopoverX::begin([
    'placement' => PopoverX::ALIGN_AUTO,
    'toggleButton' => ['label'=>'<i class="glyphicon glyphicon-calendar"></i> Selecionar mes', 'class'=>'btn btn-success'],
    'header' => '<i class="glyphicon glyphicon-calendar"></i> Selecione el mes a mostrar',
    'footer' => Html::button('<i class="glyphicon glyphicon-ok"></i>', [
            'class' => 'btn btn-sm btn-primary', 
            'onclick' => '$("#kv-login-form").trigger("submit")',
           'value'=> Url::to(['evaluacion/selecionarmes'])
        ]) 
]);
// form with an id used for action buttons in footer
$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false],'action'=>"/sisga/frontend/web/index.php/cumplimiento/selecionarmes", 'options' => ['id'=>'kv-login-form']]);
 echo Select2::widget([
    'name' => 'Mes',
    'data' =>  [
                1 => 'enero', 
                2 => 'febrero',
              3 => 'marzo', 
                4 => 'abril',
              5 => 'mayo', 
                6 => 'junio',
              7 => 'julio', 
                8 => 'agosto',
              9 => 'septiembre', 
                10 => 'octubre',
              11 => 'noviembre', 
                12 => 'diciembre',
              ],
    'options' => ['placeholder' => 'Seleciona el mes a mostrar ...'],
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

<?php
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Cumplimiento de los indicadores de Gestión</h3>',
        'type'=>'primary',
    ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'indicadores_gestionid',
            'label' => 'Indicador',
           'value'=> function ($data)
             {
              return "Ind. ".frontend\controllers\IndicadoresgestionController::buscarOrdenGeneral($data['indicadores_gestionid']);
             }
            
            ],
            [
            'attribute'=>'descripcion',
            'label' => 'Descripción',
           'value'=> function ($data)
             {
              return frontend\controllers\IndicadoresgestionController::findModel($data['indicadores_gestionid'])->descripcion;
             }
            
            ],   
            [
            'attribute'=>'indicadorid',
            'label' => 'Valor Planificado',
            'value' => function($data)
            {
             $cumplimiento = \frontend\controllers\CumplimientoController::findModel($data['id']);   
            
         return    $cumplimiento->indicadoresGestion->tope->sentido->sentido.$cumplimiento->indicadoresGestion->tope->valor;  
            }
                  
         
            ],    
                    [
            'attribute'=>'valor',
            'label' => 'Valor Real',
           
            ],    
           /*  [
            'attribute'=>'userid',
            'label' => 'Usuario que Informo',
            'value'=> function ($data)
             {
              $usuario = \frontend\controllers\UserController::findModel($data['userid']);
              return $usuario->username; 
             }     
            
            ],*/
            [
            'attribute'=>'estado_cumplimientoid',
            'label' => 'Certificado',
             'value'=> function ($data)
            {
             $cumplimiento = \frontend\controllers\CumplimientoController::findModel($data['id']);
             return $cumplimiento->estadoCumplimiento->estado;
            }
             
            ],
           
           ['class' => 'yii\grid\ActionColumn',
                
       'template' => '{view}',
             'buttons' => [
                     'view' => function ($url, $data ){
                                                            return Html::a(
                                                                            '<span class = "glyphicon glyphicon-eye-open" style="right: 0px";></span',
                                                                            $url = Url::toRoute(['cumplimiento/view', 'id' => $data['id']]),
                                                                            
                                                                             [
                                                                                 'title' => 'Ver ',
                                                                               
                                                                             ]
                                                                            );    
                                                           },
                   
                ],
        ],],
    ]);?>
  
</div>
