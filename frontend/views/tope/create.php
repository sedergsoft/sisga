<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tope */

$this->title = Yii::t('app', 'Create Tope');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Topes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tope-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
