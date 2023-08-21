<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoProyeccion */

$this->title = Yii::t('app', 'Create Tipo Proyeccion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Proyeccions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-proyeccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
