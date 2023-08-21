<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Confecionado */

$this->title = Yii::t('app', 'Create Confecionado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Confecionados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confecionado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
