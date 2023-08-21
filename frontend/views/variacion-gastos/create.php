<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\VariacionGastos */

$this->title = Yii::t('app', 'Create Variacion Gastos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Variacion Gastos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variacion-gastos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
