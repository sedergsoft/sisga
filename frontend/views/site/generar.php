<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\popover\PopoverX;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\form\ActiveForm;
//use kartik\date\DatePicker;
use kartik\touchspin\TouchSpin;
use yii\bootstrap\ButtonGroup;

//use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DireccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Generar ');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="direccion-index">
  

    <hr >
    

            <?php  PopoverX::begin([
    'placement' => PopoverX::ALIGN_AUTO_BOTTOM,
    'toggleButton' => ['label'=>'<i class="glyphicon glyphicon-calendar"></i> Selecionar mes', 'class'=>'btn btn-success'],
    'header' => 
                
                
                
                
                
                '<i class="glyphicon glyphicon-calendar"></i> Selecione el mes a generar ',
    'footer' => Html::button('<i class="glyphicon glyphicon-ok"></i>', [
            'class' => 'btn btn-sm btn-primary', 
            'onclick' => '$("#kv-login-form").trigger("submit")',
           'value'=> Url::to(['evaluacion/selecionarmes'])
        ]) 
]);
// form with an id used for action buttons in footer
$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false],'action'=>"/sisga/frontend/web/index.php/site/pdfmes", 'options' => ['id'=>'kv-login-form']]);
?>
    <p> 
        <?php 
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
    </p>
    <p>
<?php echo TouchSpin::widget([
     'name'=>'Year',
      'options' =>[
                            'class'=>'input-sm',
                            'placeholder'=>'0',
                          ],
             'pluginOptions' => [
                                    'prefix'=>'Año:',
                                    'initval'=>date('Y'),
                                    'min'=>1980,
                                    'max'=> date('Y'),
                                    'step'=>1,
                                    'buttonup_class'=>'btn btn-primary',
                                    'buttondown_class'=>'btn btn-info',
                                    'buttonup_txt'=>'<i class="glyphicon glyphicon-plus"></i>',
                                    'buttondown_txt'=>'<i class="glyphicon glyphicon-minus"></i>',    
                                ]
         
 ]);?>
        </p>
        <?php
//echo $form->field($model, 'password')->passwordInput(['placeholder'=>'Enter password...']);
ActiveForm::end();
PopoverX::end();
?>

  <?php /*echo ButtonGroup::widget([
    'buttons' => [
        ['label' => 'A'],
        ['label' => 'B'],
        ['label' => 'C'],
    ]
])*/;?>  
   <?php echo Html::a('<i class="glyphicon glyphicon-download-alt"></i> Mes Actual', ['pdf'], ['class' => 'btn btn-success'])?>
    
    <hr>
    
       
    <?= GridView::widget([
        'dataProvider' => $dataProviderObjetivo,
        'filterModel' => $searchModelObjetivo,
         'panel'=>['type'=>'primary', 'heading'=>'Objetivos',
              //'before'=>Html::a('<i class="glyphicon glyphicon-download-alt"></i> Generar PDF', ['pdf'], ['class' => 'btn btn-success']),
        
             ],
        'export'=>false,
        
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model,$key,$index, $column){
                return GridView::ROW_COLLAPSED;
                },
                'detail'=>function($model,$key,$index, $column){
                 $searchModelCriterio=new frontend\models\CriteriomedidaSearch();
                 $searchModelCriterio->Objetivoid= $model->id;
                 $searchModelIndicador = new frontend\models\IndicadoresgestionSearch();
                 $searchModelIndicador->objetivoid = $model->id;
                 $dataProviderIndicador = $searchModelIndicador->search(Yii::$app->request->queryParams);
                 $dataProviderCriterio = $searchModelCriterio->search(Yii::$app->request->queryParams);
                 $dataProviderCriterio->query->andFilterWhere(['Status'=>1])->orderBy(['Objetivoid' => SORT_ASC,'orden' => SORT_ASC])->all();
                  $dataProviderIndicador->query->orderBy(['objetivoid' => SORT_ASC,'orden' => SORT_ASC])->all();
                 
                 return Yii::$app->controller->renderPartial('_criterio',[
                     'searchModelCriterio' => $searchModelCriterio,
                     'dataProviderCriterio' =>$dataProviderCriterio,
                     'dataProviderIndicador'=>$dataProviderIndicador,
                     'searchModelIndicador'=>$searchModelIndicador,
               ]);
                },
                'contentOptions'=>[
                  'style'=>'display:flex;justify-content:space-between;',  
                ],        
                
                ],
             'orden',
             'nombre',
            'descripcion',
                        [
                       'attribute'=>'responsable',
                'value'=> function ($model){
                    return $model->responsable0->nombre;
                }, 
            ],

        ],
    ]); ?>
</div>
