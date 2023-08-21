<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Experiencia */

$this->title = Yii::t('app', 'Create Experiencia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experiencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experiencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
