<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Plantilla */

$this->title = Yii::t('app', 'Crear Plantilla');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plantillas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="plantilla-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
