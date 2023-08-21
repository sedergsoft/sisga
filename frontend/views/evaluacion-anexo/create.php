<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionAnexo */

$this->title = Yii::t('app', 'Create Evaluacion Anexo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evaluacion Anexos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluacion-anexo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
