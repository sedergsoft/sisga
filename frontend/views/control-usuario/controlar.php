<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ControlUsuario */

$this->title = Yii::t('app', 'Comprobar preguntas');
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;

?>
<div class="control-usuario-create">

   
    <?= $this->render('_formcontrol', [
        'model' => $model,
    ]) ?>

</div>
