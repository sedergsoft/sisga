<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cuadro */

$this->title = Yii::t('app', 'Update Cuadro: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['tittle'][]= $this->title;
?>
<div class="cuadro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formcuadro', [
        'model' => $model,
        'modelPersona' => $modelPersona,
        'modelPreIntel'=>$modelPreIntel,
        'modelDirCTA'=>$modelDirCTA,
        'modelCentroTrab'=>$modelCentroTrab,
        'modelCargoActual'=>$modelCargoActual,
        'modelDirectivo' =>$modelDirectivo,
        'modelSalud' => $modelSalud,
        'modelLimitaciones' => $modelLimitaciones,
        'modelsEnfermedad'=> $modelsEnfermedad,
        'modelsTrayectoriaLab'=>$modelsTrayectoriaLab,
        'modelRecidecias'=>$modelRecidecias,
        'modelDirResidencia'=>$modelDirResidencia,
        'modelsIdiomas'=>$modelsIdiomas,
        'modelTrayectoriaMilitar'=>$modelTrayectoriaMilitar,
       'modelsTrayecctoriaMiliMili'=>$modelsTrayecctoriaMiliMili,
        'modelsPreparacionMilitar'=>$modelsPreparacionMilitar,
        'modelsTrayectoriaEst'=>$modelsTrayectoriaEst,
        'modelsCentroEstudios'=>$modelsCentroEstudios,
        'modelsEscuelaPoliticaCuadro'=>$modelsEscuelaPoliticaCuadro,
         'modelsExtanciaExt'=> $modelsExtanciaExt,
        'modelsCondecoraciones'=>$modelsCondecoraciones,
        'modelsSanciones'=>$modelsSanciones,
        'modelsVehiculo'=> $modelsVehiculo,
        'modelsArma'=>$modelsArma,
        'modelsPersonaFamiliar'=>$modelsPersonaFamiliar,
        'modelsFamiliares'=>$modelsFamiliares,
        'modelsViajesFamiliares'=>$modelsViajesFamiliares,
        'modelsSancionados'=>$modelsSancionados,
        'modelsFamiliarExterior'=>$modelsFamiliarExterior,
        
            'modelsIngresosFamiliares'=>$modelsIngresosFamiliares,
            
            
                
            
            
            
       
       
        
       
            
            
            
            

    ]) ?>

</div>
