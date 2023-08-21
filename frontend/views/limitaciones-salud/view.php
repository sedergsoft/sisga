<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\LimitacionesSalud */

$this->title = $model->limitacionesid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Limitaciones Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="limitaciones-salud-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'limitacionesid' => $model->limitacionesid, 'saludid' => $model->saludid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'limitacionesid' => $model->limitacionesid, 'saludid' => $model->saludid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'limitacionesid',
            'saludid',
        ],
    ]) ?>

</div>
