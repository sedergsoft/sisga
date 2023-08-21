<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EvaluacionCuadroIndicadoresEvaluacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Evaluacion Cuadro Indicadores Evaluacions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluacion-cuadro-indicadores-evaluacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Evaluacion Cuadro Indicadores Evaluacion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'evaluacion_cuadroid',
            'Indicadores_evaluacionid',
            'evaluacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
