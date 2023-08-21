<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Integracion */

$this->title = Yii::t('app', 'Create Integracion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Integracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="integracion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
