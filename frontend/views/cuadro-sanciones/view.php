<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroSanciones */

$this->title = $model->sancionesid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadro Sanciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cuadro-sanciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'sancionesid' => $model->sancionesid, 'cuadroid' => $model->cuadroid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'sancionesid' => $model->sancionesid, 'cuadroid' => $model->cuadroid], [
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
            'sancionesid',
            'cuadroid',
        ],
    ]) ?>

</div>
