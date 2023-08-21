<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PreparacionIntelectualIdiomasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Preparacion Intelectual Idiomas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preparacion-intelectual-idiomas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Preparacion Intelectual Idiomas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'preparacion_intelectualid',
            'idiomasid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
