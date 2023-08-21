<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comedor */

$this->title = Yii::t('app', 'Datos Laborales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="comedor-create">

    <?= $this->render('_formRecidenciaActual', [
        'model' => $model,
        'modelRecidencias'=>$modelRecidencias,
        'modelDireResidencia'=>$modelDireResidencia,
                
       
    ]) ?>

</div>
