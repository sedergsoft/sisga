<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoExtancia */

$this->title = Yii::t('app', 'Create Tipo Extancia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Extancias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-extancia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
