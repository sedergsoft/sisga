<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Evaluacion */

$this->title = Yii::t('app', 'Llenar Criterio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Criterio de Medida'), 'url' => ['criteriomedida/llenar']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="evaluacion-create">


    <?= $this->render('_form', [
        'model' => $model,
        'criteriomedida'=>$criteriomedida,
        'modelanexo'=>$modelanexo,
        'modelevaluacionanexo'=>$modelevaluacionanexo,
    ]) ?>

</div>
