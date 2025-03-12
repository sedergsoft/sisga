<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Entidad */

$this->title = Yii::t('app', 'Create Entidad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="entidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
