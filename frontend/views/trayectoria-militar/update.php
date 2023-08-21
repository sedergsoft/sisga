<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaMilitar */

$this->title = Yii::t('app', 'Update Trayectoria Militar: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trayectoria Militars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="trayectoria-militar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
