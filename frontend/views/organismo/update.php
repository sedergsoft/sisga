<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Organismo */

$this->title = Yii::t('app', 'Update Organismo: {name}', [
    'name' => $model->idorganismo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organismos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idorganismo, 'url' => ['view', 'id' => $model->idorganismo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="organismo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
