<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PreparacionIntelectual */

$this->title = Yii::t('app', 'Create Preparacion Intelectual');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Preparacion Intelectuals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preparacion-intelectual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
