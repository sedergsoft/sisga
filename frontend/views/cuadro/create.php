<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cuadro */

$this->title = Yii::t('app', 'Agregar Cuadro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="cuadro-create">

    

    <?= $this->render('_form', [
        'model' => $model,
        'modelPersona' => $modelPersona,
        'modelPreIntel' => $modelPreIntel,
        'modelCentroTrab' => $modelCentroTrab,
        'modelDirCTA' => $modelDirCTA,
        'modelCargoActual' => $modelCargoActual,
        'modelDirectivo' =>$modelDirectivo,
        'modelSalud' => $modelSalud,
        'modelLimitaciones'=>$modelLimitaciones,
        'modelsTrayectoriaLab'=>$modelsTrayectoriaLab,
        'modelsResidencias' => $modelsResidencias,
        'modelsTrayectoriaEst' => $modelsTrayectoriaEst,
        'modelsPreparacionMilitar' => $modelsPreparacionMilitar,
        'modelTrayectoriaMilitar' => $modelTrayectoriaMilitar,
        'modelsTrayecctoriaMiliMili'=> $modelsTrayecctoriaMiliMili,
        'modelsEscuelaPoliticaCuadro' =>$modelsEscuelaPoliticaCuadro,
        'modelsExtanciaExt'=>$modelsExtanciaExt,
        'modelsSanciones'=>$modelsSanciones,
        'modelsVehiculo'=>$modelsVehiculo,
        'modelsArma'=>$modelsArma,
        'modelsCondecoraciones'=>$modelsCondecoraciones,
        'modelsFamiliares' => $modelsFamiliares,
         'modelsPersonaFamiliar' => $modelsPersonaFamiliar,
        'modelsOtrosFamiliares' => $modelsOtrosFamiliares,
         'modelsOtrosPersonaFamiliar' => $modelsOtrosPersonaFamiliar,
        'modelsViajesFamiliares' => $modelsViajesFamiliares,
       // 'modelsFamiliaresViajes' =>$modelsFamiliaresViajes,
       // 'modelsPersonaFamiliarViaje'=> $modelsPersonaFamiliarViaje,
        'modelsEnfermedad' => (empty($modelsEnfermedad)) ? [new Enfermedad] : $modelsEnfermedad,
        'modelsFamiliaresExterior'=>$modelsFamiliaresExterior, 
        'modelsPersonaFamiliarExterior' => $modelsPersonaFamiliarExterior,
        'modelsFamiliarExterior'=> $modelsFamiliarExterior,
        'modelsConocidosExterior' => $modelsConocidosExterior,
        'modelsConocidoExterior' => $modelsConocidoExterior,
        'modelsConocidoFamiliarExterior' => $modelsConocidoFamiliarExterior,
        
        'modelsFamiliarSancionado' => $modelsFamiliarSancionado,
            'modelsPersonaSancionada' => $modelsPersonaSancionada,
            'modelsSancionados' => $modelsSancionados,
                   'modelsConvivienteSancionados' => $modelsConvivienteSancionados,
        'modelsIngresosMonetarios' => $modelsIngresosMonetarios,
                'modelsOtrosIngresosMonetarios' => $modelsOtrosIngresosMonetarios,
            'modelsBeneficioIngresos'=>$modelsBeneficioIngresos,
        
 
    ]) ?>

</div>
