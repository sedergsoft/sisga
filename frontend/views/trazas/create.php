<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Trazas */

$this->title = Yii::t('app', 'Create Trazas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trazas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trazas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
