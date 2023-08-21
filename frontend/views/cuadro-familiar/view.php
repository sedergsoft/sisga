<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroFamiliar */

$this->title = $model->cuadroid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadro Familiars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cuadro-familiar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'cuadroid' => $model->cuadroid, 'familiarid' => $model->familiarid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'cuadroid' => $model->cuadroid, 'familiarid' => $model->familiarid], [
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
            'cuadroid',
            'familiarid',
        ],
    ]) ?>

</div>
