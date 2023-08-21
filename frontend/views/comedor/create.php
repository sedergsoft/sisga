<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comedor */

$this->title = Yii::t('app', 'Create Comedor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comedors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comedor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
