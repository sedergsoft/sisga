<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\LimitacionesSalud */

$this->title = Yii::t('app', 'Create Limitaciones Salud');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Limitaciones Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="limitaciones-salud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
