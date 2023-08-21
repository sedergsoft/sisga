<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoArma */

$this->title = Yii::t('app', 'Create Tipo Arma');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Armas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-arma-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
