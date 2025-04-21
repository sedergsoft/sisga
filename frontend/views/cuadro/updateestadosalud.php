<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Comedor */

$this->title = Yii::t('app', 'Estado de Salud: NI - '.$model->personaCI);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NI:'.$model->personaCI), 'url' => ['view','id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;

?>
<div class="comedor-create">

    <?= $this->render('_formEnfermedadupdate', [
                 'model'=>$model,
            'modelSalud'=>$modelSalud,
            'modelLimitaciones' =>$modelLimitaciones,
             'modelsEnfermedad'=>(empty($modelsEnfermedad))?[new Enfermedad()]:$modelsEnfermedad,
          
       
    ]) ?>

</div>
