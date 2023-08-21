<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TrayectoriaMilitarMilitanciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Trayectoria Militar Militancias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trayectoria-militar-militancia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Trayectoria Militar Militancia'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'trayectoria_militarid',
            'militanciaid',
            'fecha_entrada',
            'fecha_baja',
            //'causa_baja',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
