<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PerdidaInvestigacion */

$this->title = Yii::t('app', 'Create Perdida Investigacion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Perdida Investigacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perdida-investigacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
