<?php

use yii\helpers\Html;
use frontend\models\Direcciones;
use frontend\models\CentroEstudios;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroFamiliar */

$this->title = Yii::t('app', 'Agregar Cuadro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="cuadro-familiar-create">

 

    <?= $this->render('_formcuadro', [
        
             'mensaje'=>$mensaje,
            'style'=>$style,
           
            'model' => $model,
            'modelPersona' => $modelPersona,
            'modelPreIntel' => $modelPreIntel,
            'modelDirCTA' => $modelDirCTA,
            'modelCargoActual' => $modelCargoActual,
            'modelDirectivo' =>$modelDirectivo,
            'modelCentroTrab' => $modelCentroTrab,
            'modelSalud' => $modelSalud,
            'modelLimitaciones'=>$modelLimitaciones,
            'modelsEnfermedad' => (empty($modelsEnfermedad)) ? [new Enfermedad] : $modelsEnfermedad,
            'modelsPreparacionMilitar' => (empty($modelsPreparacionMilitar))?[new PreparacionMilitar]:$modelsPreparacionMilitar,
            'modelTrayectoriaMilitar' => $modelTrayectoriaMilitar,
            'modelsTrayecctoriaMiliMili'=> $modelsTrayecctoriaMiliMili,
            'modelsEscuelaPoliticaCuadro' =>$modelsEscuelaPoliticaCuadro,
            'modelRecidecias' => (empty($modelRecidecias)) ? [new LugaresResidencia] : $modelRecidecias,
            'modelDirResidencia' =>(empty($modelsDirResidencia)) ? [[new Direcciones]] : $modelsDirResidencia,
            'modelsTrayectoriaLab' =>(empty($modelsTrayectoriaLab))?[new TrayectoriaLaboral]:$modelsTrayectoriaLab,
            'modelsTrayectoriaEst' =>(empty($modelsTrayectoriaEst))?[new TrayectoriaEstudiantilCentroEstudios]:$modelsTrayectoriaEst,
           'modelsCentroEstudios'=>/*(empty($modelsCentroEstudios))?*/[[new CentroEstudios]],//:$modelsCentroEstudios,
            'modelsExtanciaExt'=>(empty($modelsExtanciaExt))?[[new EstanciaExterior]]:$modelsExtanciaExt,
            'modelsCondecoraciones'=>(empty($modelsCondecoraciones))?[new Condecoraciones]:$modelsCondecoraciones,
           'modelsSanciones'=>(empty($modelsSanciones))?[new Sanciones]:$modelsSanciones,
            'modelsVehiculo'=>(empty($modelsVehiculo))?[new Vehiculo]:$modelsVehiculo,
           'modelsArma'=>(empty($modelsArma))?[new Armas]:$modelsArma,
            'modelsFamiliares'=>(empty($modelsFamiliares))?[new Familiar]:$modelsFamiliares,
            'modelsPersonaFamiliar'=>(empty($modelsPersonaFamiliar))?[new PersonasF]:$modelsPersonaFamiliar,
            'modelsSancionados'=>(empty($modelsSancionados))?[new Sancionados()]:$modelsSancionados,
            'modelsViajesFamiliares'=>(empty($modelsViajesFamiliares))?[[new ViajesFamiliares()]]:$modelsViajesFamiliares,
            'modelsFamiliarExterior'=>(empty($modelsFamiliarExterior))?[new FamiliaresExterior()]:$modelsFamiliarExterior,
            'modelsIngresosFamiliares'=>(empty($modelsIngresosFamiliares))?[new IngresosMonetarios()]:$modelsIngresosFamiliares,
            'modelsIdiomas'=>(empty($modelsIdiomas))?[new PreparacionIntelectualIdiomas()]:$modelsIdiomas,
            'modelMiliatanciaPolitica'=>(empty($modelMiliatanciaPolitica))?new MiitanciaPoliticCuadro():$modelMiliatanciaPolitica,
        ]) ?>

</div>
