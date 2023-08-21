<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TopeIndicador */

$this->title = Yii::t('app', 'Create Tope Indicador');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tope Indicadors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tope-indicador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
