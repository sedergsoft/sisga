<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaEstudiantilCentroEstudios */

$this->title = $model->trayectoria_estudiantilid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trayectoria Estudiantil Centro Estudios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trayectoria-estudiantil-centro-estudios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'trayectoria_estudiantilid' => $model->trayectoria_estudiantilid, 'centro_estudiosid' => $model->centro_estudiosid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'trayectoria_estudiantilid' => $model->trayectoria_estudiantilid, 'centro_estudiosid' => $model->centro_estudiosid], [
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
            'trayectoria_estudiantilid',
            'centro_estudiosid',
            'fecha_inicio',
            'fecha_fin',
        ],
    ]) ?>

</div>
