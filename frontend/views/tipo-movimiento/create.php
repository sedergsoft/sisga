<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoMovimiento */

$this->title = Yii::t('app', 'Create Tipo Movimiento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Movimientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-movimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
