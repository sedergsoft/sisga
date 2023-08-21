<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoSancion */

$this->title = Yii::t('app', 'Create Tipo Sancion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Sancions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-sancion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
