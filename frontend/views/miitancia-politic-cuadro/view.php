<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MiitanciaPoliticCuadro */

$this->title = $model->miitancia_politicid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Miitancia Politic Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="miitancia-politic-cuadro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'miitancia_politicid' => $model->miitancia_politicid, 'cuadroid' => $model->cuadroid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'miitancia_politicid' => $model->miitancia_politicid, 'cuadroid' => $model->cuadroid], [
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
            'miitancia_politicid',
            'cuadroid',
        ],
    ]) ?>

</div>
