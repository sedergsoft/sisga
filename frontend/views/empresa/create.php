<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Empresa */

$this->title = Yii::t('app', 'Crear Empresa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="empresa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
