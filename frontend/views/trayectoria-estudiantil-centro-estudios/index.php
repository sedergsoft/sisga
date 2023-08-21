<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TrayectoriaEstudiantilCentroEstudiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Trayectoria Estudiantil Centro Estudios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trayectoria-estudiantil-centro-estudios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Trayectoria Estudiantil Centro Estudios'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'trayectoria_estudiantilid',
            'centro_estudiosid',
            'fecha_inicio',
            'fecha_fin',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
