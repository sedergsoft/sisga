<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroEntidad */

$this->title = Yii::t('app', 'Create Cuadro Entidad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadro Entidads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuadro-entidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
