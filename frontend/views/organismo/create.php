<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Organismo */

$this->title = Yii::t('app', 'Crear Organismo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organismos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="organismo-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
