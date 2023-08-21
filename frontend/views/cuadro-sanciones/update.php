<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroSanciones */

$this->title = Yii::t('app', 'Update Cuadro Sanciones: {name}', [
    'name' => $model->sancionesid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadro Sanciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sancionesid, 'url' => ['view', 'sancionesid' => $model->sancionesid, 'cuadroid' => $model->cuadroid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cuadro-sanciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
