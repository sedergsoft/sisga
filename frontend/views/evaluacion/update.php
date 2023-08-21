<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Evaluacion */

$this->title = Yii::t('app', 'Actualizar Evaluación: {name}', ['name' => 'Criterio '. frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($criteriomedida->id)]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evaluación'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar Evaluación: {name}', ['name' => 'Criterio '. frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($criteriomedida->id)]);

$this->params['tittle'][] = Yii::t('app', 'Actualizar Evaluación: {name}', ['name' => 'Criterio '. frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($criteriomedida->id)]);

?>
<div class="evaluacion-update">

   

    <?= $this->render('_form', [
       'model' => $model,
       'criteriomedida'=>$criteriomedida,
        'modelevaluacionanexo'=>$modelevaluacionanexo,
    ]) ?>

</div>
