<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FamiliarIntegracion */

$this->title = Yii::t('app', 'Update Familiar Integracion: {name}', [
    'name' => $model->familiarid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Familiar Integracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->familiarid, 'url' => ['view', 'familiarid' => $model->familiarid, 'integracionid' => $model->integracionid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="familiar-integracion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
