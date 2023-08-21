<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CentroEstudios */

$this->title = Yii::t('app', 'Create Centro Estudios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Centro Estudios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-estudios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
