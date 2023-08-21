<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FondoSalario */

$this->title = Yii::t('app', 'Create Fondo Salario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fondo Salarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fondo-salario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
