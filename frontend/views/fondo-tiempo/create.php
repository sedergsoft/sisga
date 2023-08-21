<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FondoTiempo */

$this->title = Yii::t('app', 'Create Fondo Tiempo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fondo Tiempos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fondo-tiempo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
