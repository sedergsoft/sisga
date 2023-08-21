<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\FamiliarIntegracion */

$this->title = $model->familiarid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Familiar Integracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="familiar-integracion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'familiarid' => $model->familiarid, 'integracionid' => $model->integracionid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'familiarid' => $model->familiarid, 'integracionid' => $model->integracionid], [
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
            'familiarid',
            'integracionid',
        ],
    ]) ?>

</div>
