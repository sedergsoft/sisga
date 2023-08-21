<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroFamiliar */

$this->title = Yii::t('app', 'Crear Cuadro cuadro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadro'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuadro-familiar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formcuadro', [
        'model' => $model,
    ]) ?>

</div>
