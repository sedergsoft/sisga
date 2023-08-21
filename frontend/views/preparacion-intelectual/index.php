<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PreparacionIntelectualSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Preparacion Intelectuals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preparacion-intelectual-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Preparacion Intelectual'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nivel_escolaridad',
            'Especialidad',
            'grado_cientifico',
            'categoria_docente',
            //'informatica',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
