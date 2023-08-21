<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EstadoCumplimiento */

$this->title = Yii::t('app', 'Create Estado Cumplimiento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estado Cumplimientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="estado-cumplimiento-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
