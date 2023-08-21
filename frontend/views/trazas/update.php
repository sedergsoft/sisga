<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Trazas */

$this->title = Yii::t('app', 'Update Trazas: {name}', [
    'name' => $model->IdTraza,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trazas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IdTraza, 'url' => ['view', 'id' => $model->IdTraza]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="trazas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
