<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CentroTrabajoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Centro Trabajos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-trabajo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Centro Trabajo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'centro',
            'direccionesid',
            'telefono',
            'email:email',
            //'idorganismo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
