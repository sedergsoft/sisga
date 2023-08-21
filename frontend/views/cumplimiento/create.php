<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cumplimiento */

$this->title = Yii::t('app', 'LLenar Indicador');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indicadores de Gestión'), 'url' => ['/indicadoresgestion/llenar']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="cumplimiento-create">

       <?= $this->render('_form', [
          'model' => $model,
          'modelindicador'=>$modelindicador,
           'modelcumplimientoanexo' => $modelcumplimientoanexo,
    ]) ?>

</div>
