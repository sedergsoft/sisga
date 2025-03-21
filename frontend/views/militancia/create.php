<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Militancia */

$this->title = Yii::t('app', 'Create Militancia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Militancias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="militancia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
