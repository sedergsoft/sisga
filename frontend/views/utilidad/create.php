<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Utilidad */

$this->title = Yii::t('app', 'Create Utilidad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utilidads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
