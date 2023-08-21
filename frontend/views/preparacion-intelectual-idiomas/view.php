<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PreparacionIntelectualIdiomas */

$this->title = $model->preparacion_intelectualid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Preparacion Intelectual Idiomas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="preparacion-intelectual-idiomas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'preparacion_intelectualid' => $model->preparacion_intelectualid, 'idiomasid' => $model->idiomasid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'preparacion_intelectualid' => $model->preparacion_intelectualid, 'idiomasid' => $model->idiomasid], [
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
            'preparacion_intelectualid',
            'idiomasid',
        ],
    ]) ?>

</div>
