<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Limitaciones */

$this->title = Yii::t('app', 'Create Limitaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Limitaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="limitaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
