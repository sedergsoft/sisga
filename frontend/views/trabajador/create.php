<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Trabajador */

$this->title = Yii::t('app', 'Create Trabajador');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trabajadors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trabajador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
