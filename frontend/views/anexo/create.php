<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Anexo */

$this->title = Yii::t('app', 'Create Anexo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anexos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anexo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
