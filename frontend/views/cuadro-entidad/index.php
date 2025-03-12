<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CuadroEntidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuadro Entidads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuadro-entidad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuadro Entidad'), ['createwiz'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'filterModel' => $searchModel,
        'columns' => [
        'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> Direciones</h3>',
        'type'=>'primary',
        // 'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Agregar ', ['value'=>Url::to('index.php?r=mesa/create'),'class' => 'btn btn-success','id'=>'modalButton']),
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['createwiz'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false
    ],/*
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cuadro_id',
            'entidad_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
