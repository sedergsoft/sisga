<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\InformacionLaboratorios */

$this->title = Yii::t('app', 'Create Informacion Laboratorios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Informacion Laboratorios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informacion-laboratorios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
