<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Capital */

$this->title = Yii::t('app', 'Create Capital');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Capitals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="capital-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
