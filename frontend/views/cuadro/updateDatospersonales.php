<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cuadro */

$this->title = Yii::t('app', 'Actualizar Cuadro: {name}', [
    'name' => $model->personaCI,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'NI - '.$model->personaCI, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar: NI - '.$model->personaCI);
$this->params['tittle'][]= $this->title;
?>
<div class="cuadro-update">

  

    <?= $this->render('_formupdateDatosPersonales', [
           'model' => $model,
           'modelPersona'=>$modelPersona,
          
            
            

    ]) ?>

</div>
