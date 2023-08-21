<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ciclos */

$this->title = Yii::t('app', 'Create Ciclos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ciclos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciclos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
