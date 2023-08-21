<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroSanciones */

$this->title = Yii::t('app', 'Create Cuadro Sanciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadro Sanciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuadro-sanciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
