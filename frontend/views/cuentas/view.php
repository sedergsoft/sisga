<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cuentas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cuentas-view">

    
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'representatividad',
            'id',
            'total_cuentas_vencidas',
            'no_vencidas',
            'saldo_sentencias_judiciales',
            'empresaid',
            'cxc_litigio',
            'nm_no_vencida',
            'efectos',
            'mn_total_vencida',
            'ExC_litigio',
            'ventas_acumuladas',
            'fecha',
            'tipo_cuentaid',
            'efectiviadad',
            'vencidas',
            'anexoid',
        ],
    ]) ?>

</div>
