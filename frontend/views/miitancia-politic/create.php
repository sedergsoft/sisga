<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MiitanciaPolitic */

$this->title = Yii::t('app', 'Create Miitancia Politic');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Miitancia Politics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="miitancia-politic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
