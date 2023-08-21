<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Indicadoresgestion */

$this->title = Yii::t('app', 'Crear Indicador de Gestión');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indicadores de gestion'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="indicadoresgestion-create">

 

    <?= $this->render('_formEdit', [
        'model' => $model,
        'modeltope' => $modeltope,
    ]) ?>

</div>
