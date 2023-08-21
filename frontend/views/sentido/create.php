<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Sentido */

$this->title = Yii::t('app', 'Create Sentido');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sentidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sentido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
