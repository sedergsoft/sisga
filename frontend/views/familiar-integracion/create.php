<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FamiliarIntegracion */

$this->title = Yii::t('app', 'Create Familiar Integracion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Familiar Integracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="familiar-integracion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
