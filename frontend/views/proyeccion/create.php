<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Proyeccion */

$this->title = Yii::t('app', 'Create Proyeccion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proyeccions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyeccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
