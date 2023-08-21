<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CumplimientoAnexo */

$this->title = Yii::t('app', 'Create Cumplimiento Anexo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cumplimiento Anexos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cumplimiento-anexo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
