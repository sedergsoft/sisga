<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Utilidadxpeso */

$this->title = Yii::t('app', 'Create Utilidadxpeso');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utilidadxpesos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilidadxpeso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
