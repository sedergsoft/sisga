<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Productividad */

$this->title = Yii::t('app', 'Create Productividad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productividads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productividad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
