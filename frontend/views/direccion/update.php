<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Entidad */

$this->title = Yii::t('app', 'Update Entidad: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entidad'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="entidad-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
