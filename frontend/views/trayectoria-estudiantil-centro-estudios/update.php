<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrayectoriaEstudiantilCentroEstudios */

$this->title = Yii::t('app', 'Editar Centro de estudios de : {name}', [
    'name' => ucwords($cuadro->personaCI0->Nombre).' '.ucwords($cuadro->personaCI0->primer_apellido).' '.ucwords($cuadro->personaCI0->segundo_apellido),]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['cuadro/index']];
$this->params['breadcrumbs'][] = ['label' => 'NI :'.($cuadro->personaCI0->CI), 'url' => ['cuadro/view', 'id' => $cuadro->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar Centro de estudios');
$this->params['tittle'][] = $this->title;
?>
<div class="trayectoria-estudiantil-centro-estudios-update">

   
    <?= $this->render('_form', [
          'model' => $model,
            'modelCentroEstudios'=>$modelCentroEstudios,
            'cuadro'=>$cuadro,
           ]) ?>

</div>
