<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DireccionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Direcciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direcciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Direcciones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'calle',
            'numero',
            'edif',
            'apto',
            //'piso',
            //'entre_calle_uno',
            //'entre_calle_dos',
            //'Reparto',
            //'provinciaid',
            //'municipioid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
