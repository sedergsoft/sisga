<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaEstudiantil */

$this->title = Yii::t('app', 'Create Trayectoria Estudiantil');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trayectoria Estudiantils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trayectoria-estudiantil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
