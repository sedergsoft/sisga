<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\OpinionEvaluado */

$this->title = Yii::t('app', 'Create Opinion Evaluado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Opinion Evaluados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opinion-evaluado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
