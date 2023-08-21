<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BeneficioIngresos */

$this->title = Yii::t('app', 'Create Beneficio Ingresos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beneficio Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beneficio-ingresos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
