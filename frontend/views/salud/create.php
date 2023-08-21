<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Salud */

$this->title = Yii::t('app', 'Create Salud');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
