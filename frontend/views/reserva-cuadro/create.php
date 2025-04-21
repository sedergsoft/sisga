<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReservaCuadro */

$this->title = Yii::t('app', 'Selecionar Reserva de Cuadro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reserva Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="reserva-cuadro-create">

 

    <?= $this->render('_form', [
        'model' => $model,
        'cuadro' => $cuadro,
    ]) ?>

</div>
