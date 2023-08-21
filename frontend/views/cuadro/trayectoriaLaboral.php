<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TrayectoriaLaboralSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Trayectoria Laborals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trayectoria-laboral-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Trayectoria Laboral'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ocupacion',
            'fecha_inicio',
            'fecha_fin',
            'motivo_cambio',
            'cuadroid',
            'centro_trabajo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
