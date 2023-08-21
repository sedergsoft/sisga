<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Objetivo */

$this->title = Yii::t('app', 'Crear Objetivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetivos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="objetivo-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
