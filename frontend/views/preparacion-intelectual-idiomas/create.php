<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PreparacionIntelectualIdiomas */

$this->title = Yii::t('app', 'Create Preparacion Intelectual Idiomas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Preparacion Intelectual Idiomas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preparacion-intelectual-idiomas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
