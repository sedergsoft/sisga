<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Capital */

$this->title = Yii::t('app', 'Update Capital: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Capitals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="capital-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
