<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PreparacionIntelectual */

$this->title = Yii::t('app', 'Actualizar Preparación Intelectual: NI - {name}', [
    'name' => $cuadro->personaCI,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['cuadro/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadro:NI - '.$cuadro->personaCI), 'url' => ['cuadro/view','id'=>$cuadro->id]];

$this->params['breadcrumbs'][] = $this->title;;
$this->params['tittle'][] = $this->title;
?>
<div class="preparacion-intelectual-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelMiliatanciaPolitica' => $modelMiliatanciaPolitica,
       
        'cuadro' => $cuadro,
    ]) ?>

</div>
