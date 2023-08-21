<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cumplimiento */

$this->title = Yii::t('app', 'Actualizar Cumplimiento: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cumplimientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
$this->params['tittle'][] = Yii::t('app', 'Actualizar');

?>
<div class="cumplimiento-update">

   

    <?= $this->render('_form', [
        'model' => $model,
        'modelindicador'=>$modelindicador,
          'modelcumplimientoanexo' => $modelcumplimientoanexo,
    ]) ?>

</div>
