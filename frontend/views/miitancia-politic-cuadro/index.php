<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MiitanciaPoliticCuadroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Miitancia Politic Cuadros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="miitancia-politic-cuadro-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Miitancia Politic Cuadro'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'miitancia_politicid',
            'cuadroid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
