<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ValorAgregado */

$this->title = Yii::t('app', 'Create Valor Agregado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Valor Agregados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valor-agregado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
