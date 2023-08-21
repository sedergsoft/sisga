<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EscuelaPolitica */

$this->title = Yii::t('app', 'Create Escuela Politica');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Escuela Politicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="escuela-politica-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
