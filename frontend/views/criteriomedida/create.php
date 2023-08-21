<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Criteriomedida */

$this->title = Yii::t('app', 'Criterio de Medida');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Criteriomedidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="criteriomedida-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
         'modelTope' => $modelTope,
         'model' => $model,
    ]) ?>

</div>
