<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaMilitarMilitancia */

$this->title = Yii::t('app', 'Create Trayectoria Militar Militancia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trayectoria Militar Militancias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trayectoria-militar-militancia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
