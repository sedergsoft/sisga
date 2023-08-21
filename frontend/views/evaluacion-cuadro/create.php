<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionCuadro */

$this->title = Yii::t('app', 'Evaluar al cuadro : '.$cuadro->personaCI0->Nombre.' '.$cuadro->personaCI0->primer_apellido.' '.$cuadro->personaCI0->segundo_apellido.' ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evaluacion Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="evaluacion-cuadro-create">
<?php if(Yii::$app->session->hasFlash("mensaje")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => $style], 'body' => $mensaje]);
        ?>
    <?php endif; ?>
    
    

    <?= $this->render('_form', [
        'model' => $model,
        'cuadro'=> $cuadro,
        'mensaje'=>$mensaje,
        'style'=>$style,
        'modelPeriodoEvaluado'=>$modelPeriodoEvaluado,
        'modelExperiencia'=>$modelExperiencia,
        'dataProviderIndicadores'=>$dataProviderIndicadores,
        'modelEvaluacionIndicador' => $modelEvaluacionIndicador,
        'modelProyeccion'=>$modelProyeccion,
       'modelEvaluacion_Indicador'=>/*(empty($modelEvaluacionIndicador))?[new \frontend\models\EvaluacionCuadroIndicadoresEvaluacion()]:*/$modelEvaluacion_Indicador,
        'modelReserva' => $modelReserva,      
        'modelOpinionEvaluado' => $modelOpinionEvaluado,
        'modelConfeccionado'=>$modelConfeccionado,
            
       
    ]) ?>

</div>
