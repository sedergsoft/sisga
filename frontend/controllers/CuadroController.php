<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use frontend\models\Cuadro;
use frontend\models\Persona;
use frontend\models\PreparacionIntelectual;
use frontend\models\CentroTrabajo;
use frontend\models\Direcciones;
use frontend\models\EnfermedadSalud;
use frontend\models\Cargo;
use frontend\models\TrayectoriaLaboral;
use frontend\models\Directivo;
use frontend\models\LugaresResidencia;
use frontend\models\TrayectoriaEstudiantil;
use frontend\models\Salud;
use frontend\models\Vehiculo;
use frontend\models\EstanciaExterior;
use frontend\models\PreparacionMilitar;
use frontend\models\CuadroEscuelaPolitica;
use frontend\models\Limitaciones;
use frontend\models\EscuelaPolitica;
use frontend\models\Enfermedad;
use frontend\models\Sanciones;
use frontend\models\CuadroSanciones;
use frontend\models\Familiar;
use frontend\models\TrayectoriaMilitarMilitancia;
use frontend\models\TrayectoriaMilitar;
use frontend\models\CuadroSearch;
use frontend\models\Condecoraciones;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Armas;
use frontend\models\ViajesFamiliares;
use frontend\models\FamiliaresExterior;
use frontend\models\Sancionados;
use frontend\models\IngresosMonetarios;
use frontend\models\BeneficioIngresos;
use frontend\models\Model;
use yii\web\UploadedFile;
use yii\imagine\Image;
use frontend\models\LimitacionesSalud;
use frontend\models\CentroEstudios;
use frontend\models\TrayectoriaEstudiantilCentroEstudios;
use frontend\models\PersonasF;
use frontend\models\CuadroIngresosMonetarios;
use frontend\models\PreparacionIntelectualIdiomas;
use frontend\models\Idiomas;
use frontend\models\MiitanciaPoliticCuadro;
use yii\helpers\Json;

/**
 * CuadroController implements the CRUD actions for Cuadro model.
 */
class CuadroController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cuadro models.
     * @return mixed
     */
    public function actionIndex()
    {
          if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);   
        }
     
        $searchModel = new CuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status'=>1]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cuadro model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id,$style = null,$mensaje = null)
    {
     
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);   
        }
        if(Yii::$app->user->identity->rolid != "6" && Yii::$app->user->identity->rolid != "7")
        {               
            throw new \yii\web\ForbiddenHttpException('Usted no tiene permisos para acceder a esta parte del sitios.');
       
        
        }  
        $searchModel = new \frontend\models\TrayectoriaLaboralSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['cuadroid'=> $id])->orderBy(['fecha_inicio' => SORT_ASC,]);
        $searchModellugaresResidencias = new \frontend\models\LugaresResidenciaSearch();
        $dataProviderlugaresResidencias = $searchModellugaresResidencias->search(Yii::$app->request->queryParams);
        $dataProviderlugaresResidencias->query->andFilterWhere(['cuadroid'=> $id]);
        
        $trayectoria = TrayectoriaEstudiantilController::findModel(['cuadroid'=>$id]);
        
        $searchModelEnfermedades = new \frontend\models\EnfermedadSaludSearch();
        $dataProviderEnfermedades = $searchModelEnfermedades->search(Yii::$app->request->queryParams);
        $dataProviderEnfermedades->query->andFilterWhere(['saludid'=>$this->findModel($id)->saludid]);
        $searchModelEscuelaPoliticaCuadro = new \frontend\models\CuadroEscuelaPoliticaSearch();
        $dataProviderEscuelaPoliticaCuadro = $searchModelEscuelaPoliticaCuadro->search(Yii::$app->request->queryParams);
        $dataProviderEscuelaPoliticaCuadro->query->andFilterWhere(['cuadroid'=> $id])->orderBy(['fecha' => SORT_ASC,] );
        
        if($this->findModel($id)->trayectoria_militarid == null)
        {
            $trayectoriaid = 0;
        }else{$trayectoriaid = $this->findModel($id)->trayectoria_militarid;}
        
        $searchModelPreparacionMilitar = new \frontend\models\PreparacionMilitarSearch();
        $dataProviderPreparacionMilitar = $searchModelPreparacionMilitar->search(Yii::$app->request->queryParams);
        $dataProviderPreparacionMilitar->query->andFilterWhere(['trayectoria_militarid'=> $trayectoriaid])->orderBy(['fecha' => SORT_ASC,] );
        
        $searchModelTrayectoriaEstudiantil = new \frontend\models\TrayectoriaEstudiantilCentroEstudiosSearch();
        $dataProviderTrayectoriaEstudiantil = $searchModelTrayectoriaEstudiantil->search(Yii::$app->request->queryParams);
        $dataProviderTrayectoriaEstudiantil->query->andFilterWhere(['cuadroid'=> $id])->orderBy(['fecha_inicio' => SORT_ASC,]);
        
        $searchModelExtanciaExt = new \frontend\models\EstanciaExteriorSearch();
        $dataProviderExtanciaExt = $searchModelExtanciaExt->search(Yii::$app->request->queryParams);
        $dataProviderExtanciaExt->query->andFilterWhere(['cuadroid'=> $id])->orderBy(['fecha' => SORT_ASC,]);
        $searchModelCondecoraciones = new \frontend\models\CondecoracionesSearch();
        $dataProviderCondecoraciones = $searchModelCondecoraciones->search(Yii::$app->request->queryParams);
        $dataProviderCondecoraciones->query->andFilterWhere(['cuadroid'=> $id])->orderBy(['fecha' => SORT_ASC,]);
        $searchModelCuadroSanciones = new \frontend\models\CuadroSancionesSearch();
        $dataProviderCuadroSanciones = $searchModelCuadroSanciones->search(Yii::$app->request->queryParams);
        $dataProviderCuadroSanciones->query->andFilterWhere(['cuadroid'=> $id]);
        
        $searchModelVehiculo = new \frontend\models\VehiculoSearch();
        $dataProviderVehiculo = $searchModelVehiculo->search(Yii::$app->request->queryParams);
        $dataProviderVehiculo->query->andFilterWhere(['cuadroid'=> $id]);
        
        $searchModelArma = new \frontend\models\ArmasSearch();
        $dataProviderArma = $searchModelArma->search(Yii::$app->request->queryParams);
        $dataProviderArma->query->andFilterWhere(['cuadroid'=> $id]);
        
        $searchModelFamiilar = new \frontend\models\CuadroFamiliarSearch();
        $dataProviderFamiilar = $searchModelFamiilar->search(Yii::$app->request->queryParams);
        $dataProviderFamiilar->query->andFilterWhere(['cuadroid'=> $id,'active'=>1]);
        
        $searchModelViajesFamiilar = new \frontend\models\ViajesFamiliaresRelacionadosSearch();
        $dataProviderViajesFamiilar = $searchModelViajesFamiilar->search(Yii::$app->request->queryParams);
        $dataProviderViajesFamiilar->query->andFilterWhere(['cuadroid'=> $id,'active'=>1])->andFilterWhere(['viaje'=>1]);
       
        $searchModelSancionados = new \frontend\models\SancionadosSearch();
        $dataProviderSancionados = $searchModelSancionados->search(Yii::$app->request->queryParams);
        $dataProviderSancionados->query->andFilterWhere(['cuadroid'=> $id,'active'=>1])->andFilterWhere(['sancionado'=> 1]);

        $searchModelFamiliaresResidentes = new \frontend\models\FamiliaresExteriorSearch();
        $dataProviderFamiliaresResidentes = $searchModelFamiliaresResidentes->search(Yii::$app->request->queryParams);
        $dataProviderFamiliaresResidentes->query->andFilterWhere(['cuadroid'=> $id,'active'=>1]);
        
        $searchModelIngresosFamiliares = new \frontend\models\IngresosMonetariosSearch();
        $dataProviderIngresosFamiliares = $searchModelIngresosFamiliares->search(Yii::$app->request->queryParams);
        $dataProviderIngresosFamiliares->query->andFilterWhere(['cuadroid'=> $id])->andFilterWhere(['status'=> 1]);
//        $query = ViajesFamiliares::find()->leftJoin( 'cuadro_familiar','cuadro_familiar.familiarid = viajes_familiares.familiarid')->andWhere(['cuadro_familiar.cuadroid'=>$id])->all();
//        
//        $viajesFamiliares = new ActiveDataProvider([
//            'query' => $query,
//        ]);
       
        //$viajesFamiliares->query = ViajesFamiliares::find()->leftJoin( 'cuadro_familiar','cuadro_familiar.familiarid = viajes_familiares.familiarid')->andWhere(['cuadro_familiar.cuadroid'=>$id])->all();
        
        
        //return print_r($viajesFamiliares);
        
        return $this->render('view', [
            'style'=>$style,
            'mensaje'=>$mensaje,
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' =>$dataProvider,
            'searchModellugaresResidencias' => $searchModellugaresResidencias,
            'dataProviderlugaresResidencias' =>$dataProviderlugaresResidencias,
            'searchModelTrayectoriaEstudiantil' => $searchModelTrayectoriaEstudiantil,
            'dataProviderTrayectoriaEstudiantil' =>$dataProviderTrayectoriaEstudiantil,
            'dataProviderEnfermedades' =>$dataProviderEnfermedades,
            'dataProviderEscuelaPoliticaCuadro' =>$dataProviderEscuelaPoliticaCuadro,
            'dataProviderPreparacionMilitar' =>$dataProviderPreparacionMilitar,
            'dataProviderExtanciaExt' =>$dataProviderExtanciaExt,
            'dataProviderCondecoraciones' =>$dataProviderCondecoraciones,
            'dataProviderCuadroSanciones' =>$dataProviderCuadroSanciones,
            'dataProviderVehiculo' =>$dataProviderVehiculo,
            'dataProviderArma'=>$dataProviderArma,
            'dataProviderFamiilar'=>$dataProviderFamiilar,
            'dataProviderViajesFamiilar' =>$dataProviderViajesFamiilar,
            'dataProviderFamiliaresResidentes' =>$dataProviderFamiliaresResidentes,
            'dataProviderIngresosFamiliares' =>$dataProviderIngresosFamiliares,
            'dataProviderSancionados' =>$dataProviderSancionados,
        ]);
    }

    /**
     * Creates a new Cuadro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);   
        }
        if(Yii::$app->user->identity->rolid != "6")
        {               
            throw new \yii\web\ForbiddenHttpException('Usted no tiene permisos para acceder a esta parte del sitios.');
       
        
        }
        
        
        $model = new Cuadro();
        $modelPersona = new Persona();
        $modelPreIntel = new PreparacionIntelectual();
        $modelCentroTrab = new CentroTrabajo();
        $modelDirCTA = new Direcciones();
        $modelDirResidencia = [[new Direcciones]];
        $modelCargoActual  = new Cargo();
        $modelDirectivo = new Directivo();
        $modelSalud = new Salud();
        $modelLimitaciones = new Limitaciones();
        $modelsEnfermedad = [new Enfermedad];
        $modelsArma = [new Armas];
         $modelsPreparacionMilitar = [new PreparacionMilitar];
        $modelTrayectoriaMilitar = new TrayectoriaMilitar();
        $modelsTrayecctoriaMiliMili = new TrayectoriaMilitarMilitancia();
        $modelsEscuelaPoliticaCuadro = [new CuadroEscuelaPolitica];
        $modelsEscuelaPolitica = [new EscuelaPolitica];
        $modelRecidecias = [new LugaresResidencia];
        $modelLimitacionSalud = new LimitacionesSalud();
        $modelsTrayectoriaLab = [new TrayectoriaLaboral()];
        $modelsTrayectoriaEst = [new TrayectoriaEstudiantilCentroEstudios];
        $modelsCentroEstudios = [[new CentroEstudios()]];    
        $modelsExtanciaExt = [new EstanciaExterior];
        $modelsCondecoraciones = [new Condecoraciones];
        $modelsSanciones = [new Sanciones];
        $modelsVehiculo = [new Vehiculo];
        $modelsPersonaFamiliar = [new PersonasF];
        $modelsFamiliares = [new Familiar];
        $modelsSancionados = [new Sancionados];
        $modelsViajesFamiliares = [[new ViajesFamiliares]];
        $modelsFamiliarExterior = [new FamiliaresExterior];
        $modelsIngresosFamiliares = [new IngresosMonetarios];
        $modelsIdiomas = [new PreparacionIntelectualIdiomas];
        $modelMiliatanciaPolitica = new MiitanciaPoliticCuadro();
        $style = '';
        $mensaje = '';
        
                

        if ($model->load(Yii::$app->request->post())&& 
            $modelPersona->load(Yii::$app->request->post())&&
            $modelPreIntel->load(Yii::$app->request->post())&&
            $modelDirCTA->load(Yii::$app->request->post())&&
            $modelDirectivo->load(Yii::$app->request->post())&&
            $modelCentroTrab->load(Yii::$app->request->post())&&
            $modelSalud->load(Yii::$app->request->post())&&
            $modelLimitaciones->load(Yii::$app->request->post())&&
            $modelTrayectoriaMilitar->load(Yii::$app->request->post())&&
            $modelsTrayecctoriaMiliMili->load(Yii::$app->request->post())&&
            $modelCargoActual->load(Yii::$app->request->post()))
            {  

                $modelRecidecias= Model::createMultiple(LugaresResidencia::className());
                $modelsEscuelaPoliticaCuadro= Model::createMultiple(CuadroEscuelaPolitica::className());
                $modelsEnfermedad = Model::createMultiple(Enfermedad::classname()); //metodo que permite crear multiples instacias de un modelo
                $modelsTrayectoriaLab = Model::createMultiple(TrayectoriaLaboral::classname()); //metodo que permite crear multiples instacias de un modelo
                $modelsSanciones = Model::createMultiple(Sanciones::classname()); //metodo que permite crear multiples instacias de un modelo
                $modelsVehiculo = Model::createMultiple(Vehiculo::classname()); //metodo que permite crear multiples instacias de un modelo
                 $modelsArma = Model::createMultiple(Armas::classname()); //metodo que permite crear multiples instacias de un modelo
                 $modelsPersonaFamiliar = Model::createMultiple(PersonasF::classname()); //metodo que permite crear multiples instacias de un modelo
                 $modelsFamiliares = Model::createMultiple(Familiar::classname()); //metodo que permite crear multiples instacias de un modelo
                 $modelsSancionados = Model::createMultiple(Sancionados::classname()); //metodo que permite crear multiples instacias de un modelo
                 $modelsFamiliarExterior = Model::createMultiple(FamiliaresExterior::classname()); //metodo que permite crear multiples instacias de un modelo
                 $modelsIngresosFamiliares = Model::createMultiple(IngresosMonetarios::classname()); //metodo que permite crear multiples instacias de un modelo
                 $modelsIdiomas = Model::createMultiple(PreparacionIntelectualIdiomas::classname()); //metodo que permite crear multiples instacias de un modelo
                 $modelsCondecoraciones = Model::createMultiple(Condecoraciones::classname()); //metodo que permite crear multiples instacias de un modelo

             
                Model::loadMultiple($modelsEnfermedad, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelRecidecias, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsTrayectoriaLab, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsTrayectoriaEst, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsEscuelaPoliticaCuadro, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsExtanciaExt, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsCondecoraciones, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsSanciones, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsVehiculo, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsArma, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsPersonaFamiliar, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsFamiliares, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsSancionados, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsFamiliarExterior, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsIngresosFamiliares, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                Model::loadMultiple($modelsIdiomas, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
              //  Model::loadMultiple($modelMiliatanciaPolitica, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                //validacion ajax
           if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($model),
                    ActiveForm::validate($modelsEnfermedad),
                    ActiveForm::validate($modelDirResidencia),
                    ActiveForm::validate($modelRecidecias)
                );
            }
           
            $valid = Model::validateMultiple($modelsEnfermedad);
            $validR = Model::validateMultiple($modelRecidecias);
            $validCT = Model::validateMultiple($modelsTrayectoriaLab);
            $validTE = Model::validateMultiple($modelsTrayectoriaEst);
            $validPF = Model::validateMultiple($modelsPersonaFamiliar);
            $validF = Model::validateMultiple($modelsFamiliares);
            $validSs = Model::validateMultiple($modelsSancionados);
            $validFE = Model::validateMultiple($modelsFamiliarExterior);
            $validIF = Model::validateMultiple($modelsIngresosFamiliares);
            $validI = Model::validateMultiple($modelsIdiomas);
            //$validPC = Model::validateMultiple($modelMiliatanciaPolitica);
            
              if (isset($_POST['Direcciones'][0][0]))
                  {
                  //return print_r($_POST['Direcciones'][0]);
                foreach ($_POST['Direcciones'][0] as $indexDireciones => $modelDireResidencia)
                    {
                        $data['Direcciones'] = $modelDireResidencia;
                        $modelDirResidencia = new Direcciones ;
                        $modelDirResidencia->load($data);
                        $modelsDirResidencia[$indexDireciones]= $modelDirResidencia;
                        $validDR = $modelDirResidencia->validate();
                      
                    }
                       //return print_r($validDR);
                }
                
                if (isset($_POST['CentroEstudios'][0][0]))
                  {
                 // return print_r($_POST);
                foreach ($_POST['CentroEstudios'][0] as $indexCentroEstudios => $modelCentroEstudio)
                    {
                   // foreach ($modelDireResidencia as $indexDireResidencia => $direccion) 
                       // {
                        $data['CentroEstudios'] = $modelCentroEstudio;
                        $modelCentroEstudio = new CentroEstudios ;
                        $modelCentroEstudio->load($data);
                        $modelsCentroEstudios[$indexCentroEstudios]/*[$indexDireResidencia]*/ = $modelCentroEstudio;
                     // return print_r($_POST['CentroEstudios'][0][0]);
                    
                        $validCE = $modelCentroEstudio->validate();
                       // }
                    }
                       //return print_r($modelsCentroEstudio);
                }
                
                 if (isset($_POST['ViajesFamiliares'][0][0])) {
                foreach ($_POST['ViajesFamiliares'] as $indexFamiliares => $viajes) {
                    foreach ($viajes as $indexViajes => $viaje) {
                        $data['ViajesFamiliares'] = $viaje;
                        $modelviajesfamiliares = new ViajesFamiliares;
                        $modelviajesfamiliares->load($data);
                        $modelsViajesFamiliares[$indexFamiliares][$indexViajes] = $modelviajesfamiliares;
                        $validVF = $modelviajesfamiliares->validate();
                    }
                }
            }
            
          //  return print_r($modelsViajesFamiliares);

                
               
            $validGeneral = $valid && /*$validEPC &&*/ $validDR && $validR && $validCT && $validCE && $validTE  &&/* $validC && $validS && $validV && $validA&& */$validPF&& $validF;
            
                //return print_r("enf".$valid."validDR".$validDR."validR".$validR."validCT".$validCT."validCE".$validCE."ValidTE".$validTE."validPF".$validPF."validF".$validF);
              // return print_r($validPF);
            if ($valid) { //si los modelos estan bien validados comienzo a almacenarlos en la BD
           
                
                
                $transaction = \Yii::$app->db->beginTransaction();
                
        //return print_r($validGeneral);
              try {
                  //--------------------
            $modelPersona->save();
            $modelPreIntel->save();
            $modelDirCTA->save();
            $modelCentroTrab->direccionesid = $modelDirCTA->id;
            $modelCentroTrab->save();
            $modelCargoActual->save();
            $modelSalud->save();
            $modelLimitaciones->save();
            
            
            $modelLimitacionSalud->saludid = $modelSalud->id;
            $modelLimitacionSalud->limitacionesid=$modelLimitaciones->id;
            $modelLimitacionSalud->save();
            
            $model->cargoid=$modelCargoActual->id;
            $model->preparacion_intelectualid = $modelPreIntel->id;
             $modelPersona->CI = $model->personaCI;
            $model->centro_trabajoid=$modelCentroTrab->id;
            $model->saludid = $modelSalud->id;
            $imagenName = trim($model->personaCI);  //guarda el nombre de la bebida para luego renombrar la imagen
            $model->file = UploadedFile::getInstance($model,'foto');
            $model->file->saveAs('uploads/cuadros/fotos/'.$imagenName.'.'.$model->file->extension); //guarda la imagen en la ruta proporcionada
            $model->foto = 'uploads/cuadros/fotos/'.$imagenName.'.'.$model->file->extension; //es asignado al campo imagen modelo bebida la ruta, el nombre y la extencion que que se guardo la imagen
          
                  
                     $validTM = false;
                      $validTMM = false;
                      $validPM = false;

                               
               //--------------------
                   if ($flag = $modelPersona->save(false)) { //si la persona se guardo sin problemas entonces comienzo a guardar los ingredientes
                      
                       if($flag = $model->save())
                       {
                        foreach ($modelsEnfermedad as $Enfermedad) 
                            {
                          
                                
                            if (! ($flag = $Enfermedad->save(false))) { //si hubo algun error el el proceso de guardado revierto el proceso

                                    $transaction->rollBack();
                                     break;
                                    }
                               
                            $modelEnfermedadSalud = new EnfermedadSalud();
                            $modelEnfermedadSalud->saludid = $modelSalud->id;
                            $modelEnfermedadSalud->enfermedadid = $Enfermedad->id;
                            $modelEnfermedadSalud->save();    

                        }
                       }
                         if($flag)
                         {
                             
                             if (isset($_POST['MiitanciaPolitic'][0])) {
                            foreach ($_POST['MiitanciaPolitic'] as $Militancia) 
                                {
                                    $militanciapolitica = new MiitanciaPoliticCuadro();
                                    $militanciapolitica->cuadroid = $model->id;
                                    $militanciapolitica->miitancia_politicid = $Militancia->miitancia_politicid;
                                    if (!$flag=$militanciapolitica->save())
                                    {
                                     $transaction->rollBack();
                                     break;
                                      
                                    }
                                
                               
                                }
                
                             
                              }
                         }
                         if($flag)
                         {
                     //  return print_r($modelsTrayectoriaLab);
                        foreach ($modelsTrayectoriaLab as $trayectorialaboral)
                        {
                          $trayectorialaboral->cuadroid=$model->id;  
                          if(!($flag = $trayectorialaboral->save()))
                          {
                              $transaction->rollBack();
                              break;
                          }
                        }
                         }
                        if($flag)
                        {
                            if($modelTrayectoriaMilitar->active ==1)
                                 {
                                      $modelTrayectoriaMilitar->scenario = 'CTrayectoriamilitar';
                                      $validTM = $modelTrayectoriaMilitar->validate();
                                      if($validTM)
                                      {
                                          $modelsTrayecctoriaMiliMili->scenario = 'CTrayectoriaMilitarMili'; 
                                          $validTMM = $modelsTrayecctoriaMiliMili->validate();
                                          if($validTMM)
                                          {
                                               $modelsPreparacionMilitar = Model::createMultiple(PreparacionMilitar::classname()); //metodo que permite crear multiples instacias de un modelo
                                                Model::loadMultiple($modelsPreparacionMilitar, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                                               $validPM = Model::validateMultipleScenario($modelsPreparacionMilitar,'CPreparacionmilitar');
                                               if($validTMM)
                                                   {
                                                    $modelTrayectoriaMilitar->save();   
                                                    $modelsTrayecctoriaMiliMili->trayectoria_militarid = $modelTrayectoriaMilitar->id;
                                                    $modelsTrayecctoriaMiliMili->save();
                                                    $model->trayectoria_militarid = $modelTrayectoriaMilitar->id;
                                                   
                                                    if($validPM)
                                                    {
                                                      foreach ($modelsPreparacionMilitar as $indexPreparacionMilitar =>$modelPreparacionMilitar)
                                                        {
                                                            if($flag === false)
                                                            {
                                                                $transaction->rollBack();
                                                                break;
                                                            }
                                                            $modelPreparacionMilitar->trayectoria_militarid = $modelTrayectoriaMilitar->id;
                                                            if(!($flag=$modelPreparacionMilitar->save()))
                                                            {
                                                                $transaction->rollBack();
                                                                break;
                                                            }
                                                        }  
                                                    }
                                                    else{
                                                        $transaction->rollBack();
                                                        }
                                                   }
                                                   else{
                                                       $transaction->rollBack();
                                                        }
                                          }
                                          else{
                                               $transaction->rollBack();
                                                }

                                      }
                                 }
                            
                            
                            
                            
                            
                            
                            
                        }
                          
                        if($flag)
                        {
                           if($_POST['CuadroEscuelaPolitica']['active'] == 1)
                            {
                                 $validEPC = Model::validateMultipleScenario($modelsEscuelaPoliticaCuadro,'CEscuelapolitica');
                                // return print_r($validEPC);
                                 if(!$validEPC)
                                  {
                                     $this->ScenarioD($modelsEscuelaPoliticaCuadro);
                                     Yii::$app->session->setFlash('error_validacion');
                                      $mensaje = 'Los datos correspondientes a las escuelas politicas están incorrectos o incompletos';
                                      $style = 'alert-danger';
                                      $transaction->rollBack();
                                    //return print_r($validEPC); 
                                     $flag = false;
                                 }
                                // return print_r($validEPC);
                                 else{
                                       
                                            $lengt = 0;
                                            while ($lengt < sizeof($modelsEscuelaPoliticaCuadro)-1)
                                            {
                                              $modelEscuelaPoliticaCuadro = $modelsEscuelaPoliticaCuadro[$lengt];
                                              $modelEscuelaPoliticaCuadro->cuadroid=$model->id;
                                              $lengt++;
                                              
                                             if(!($flag = $modelEscuelaPoliticaCuadro->save()))
                                             {
                                                 $transaction->rollBack();
                                                 break;
                                             }
                                            }
                                            }
                                     
                                     //--
                                   /*  {
                                     foreach ($modelsEscuelaPoliticaCuadro as $indexEscuelaPoliticaCuadro =>$modelEscuelaPoliticaCuadro)
                                        {
                                          if($flag===false) 
                                            {$transaction->rollBack ();
                                            break;
                                            }

                                             $modelEscuelaPoliticaCuadro->cuadroid=$model->id;
                                             if(!($flag = $modelEscuelaPoliticaCuadro->save()))
                                             {
                                                 $transaction->rollBack();
                                                 break;
                                             }

                                         }
                                     
                                     
                                     }*/ //
                                 
                            }
            
                            
                            
                            
                            
                        }
                        if ($flag ) {
                       
                            foreach ($modelRecidecias as $indexRecidencia => $modelLugarResidencia) {

                                                 
                            if ($flag === false) {
                                $transaction->rollBack();
                                break;
                            }
                           //return print_r($modelLugarResidencia);
                            if(!($flag = $modelDirResidencia->save()))
                            {
                                $transaction->rollBack();
                                break;
                                
                            }
                           
                         
                        $modelLugarResidencia->direccionesid = $modelDirResidencia->id;
                        $modelLugarResidencia->cuadroid = $model->id;                                       
                        
                        
                        $validD = false;  //variable que almacena el resultado de la validacion del modelo directivo
                        
                          
                        if($modelDirectivo->active == 1) //compruebo si tiene trayectioria como directivo 
                          {
                                $modelDirectivo->scenario = 'CDirectivo'; //pongo el escenario crear directivo en el modelo directivo
                                $validD = $modelDirectivo->validate(); //valido el modelo dirctivo
                                if($validD)
                                {
                                  
                                    $modelDirectivo->cuadroid = $model->id;
                                    if(!$flag = $modelDirectivo->save())
                                    {
                                     $transaction->rollBack();
                                                break;   
                                    }
                                }
                                else{
                                     Yii::$app->session->setFlash('error_validacion');
                                      $mensaje = 'Los datos correspondientes a la  Trayectoria como directivo están incorrectos o incompletos';
                                      $style = 'alert-danger';
                                      $modelDirectivo->scenario = 'default';
                                    //return print_r($validEPC); 
                                      $flag = false;
                                //return print_r($validD.'goto-');
                                    }
                           }
                           //return print_r($flag.'Lugar');  
                        if (!($flag = $modelLugarResidencia->save(false))) {
                                $transaction->rollBack();
                                        break;
                                    
                                }
                        
            }
            
                       //return print_r($flag.'DR2');                           
                         
                        }
                        if($flag)
                        {
                           $modelTrayectoriaEstudiantil = new TrayectoriaEstudiantil();
                           $modelTrayectoriaEstudiantil->cuadroid = $model->id;
                           
                           if(!($flag = $modelTrayectoriaEstudiantil->save(false)))
                           {
                             $transaction->rollBack();
                                      
                                  
                           }
                           if($flag)
                           {  
                            foreach ( $modelsTrayectoriaEst as $indexTrayectoriaEst => $modelTrayectoriaEstu)
                            {
                               //return print_r($modelsCentroEstudios);
                                foreach($modelsCentroEstudios as $indexCentroEstudios => $modelCentroEstudios)
                                {
                              // return print_r($modelCentroEstudios);
                                 
                                    if(!($flag = $modelCentroEstudios->save(false)))
                                     {
                                     $transaction->rollBack();
                                     break;

                                     }
                                $modelTrayectoriaEstu->centro_estudiosid = $modelCentroEstudios->id;
                                $modelTrayectoriaEstu->trayectoria_estudiantilid = $modelTrayectoriaEstudiantil->id;
                                if(!($flag = $modelTrayectoriaEstu->save(false)))
                                       {
                                         $transaction->rollBack();
                                                    break;

                                       }
                                 
                                       
                                }
                            }
                           }
                           // print_r($modelCentroEstudio);
                        }
                        if($flag)
                        {
                             if($_POST['EstanciaExterior']['active'] == 1)
                                {
                                 $validEExt = Model::validateMultipleScenario($modelsExtanciaExt,'CExtancia');
                                    if(!$validEExt)
                                      {
                                        $this->ScenarioD($modelsExtanciaExt);
                                        Yii::$app->session->setFlash('error_validacion');
                                        $mensaje = 'Los datos correspondientes a las estancias en el exterior están incorrectos o incompletos';
                                        $style = 'alert-danger';
                                        $transaction->rollBack();
                                        $flag = false;
                                    }
                                    else{
                                       $lengt = 0;
                                            
                                            while ($lengt < sizeof($modelsExtanciaExt)-1)
                                            {
                                              $modelEstacia = $modelsExtanciaExt[$lengt];
                                              $modelEstacia->cuadroid = $model->id;
                                              $lengt++;
                                              
                                              if(!($flag = $modelEstacia->save(false)))
                                            {
                                               $transaction->rollBack();
                                               break;
                                            }
                                            }
                                            }
                                        //---
                                            /*
                                        foreach ($modelsExtanciaExt as $modelEstacia)
                                        {
                                            $modelEstacia->cuadroid = $model->id;
                                            if(!($flag = $modelEstacia->save(false)))
                                            {
                                               $transaction->rollBack();
                                               break;
                                            }
                                        }
                                    }*/
                                }
                        }   
                        if($flag)
                        {
                            
                             if($_POST['Condecoraciones']['active'] == 1)
                                {
                                     //return print_r($modelsCondecoraciones);
                                     //return print_r('m'.sizeof($modelsCondecoraciones)-1 .'<-');
                                           
                                    $validC = Model::validateMultipleScenario($modelsCondecoraciones,'CCondecoraciones');
                                    if(!$validC)
                                      {
                                        $this->ScenarioD($modelsCondecoraciones);
                                        Yii::$app->session->setFlash('error_validacion');
                                        $mensaje = 'Los datos correspondientes a las Condecoraciones,distinciones y estimulos están incorrectos o incompletos';
                                        $style = 'alert-danger';
                                        $transaction->rollBack();
                                        $flag = false;
                                      }
                                        else{
                                        //---
                                            $lengt = 0;
                                           // return print_r('m'.sizeof($modelsCondecoraciones)-1 .'<-');
                                            while ($lengt < sizeof($modelsCondecoraciones)-1)
                                            {
                                              $modelCondecoraciones = $modelsCondecoraciones[$lengt];
                                               $modelCondecoraciones->cuadroid = $model->id;
                                              $lengt++;
                                              
                                              if(!($flag = $modelCondecoraciones->save(false)))
                                            {
                                               $transaction->rollBack();
                                               break;
                                            }
                                            }
                                            }
                                            
                                            
                                           //-- {
                                          /*  foreach ($modelsCondecoraciones as $modelCondecoraciones)
                                            {
                                                $modelCondecoraciones->cuadroid = $model->id;
                                                if(!($flag = $modelCondecoraciones->save(false)))
                                                {
                                                   $transaction->rollBack();
                                                   break;
                                                }
                                            }
                                            }*/
                                            //---
                                }
                        }
                        
                        if($flag && $_POST['Sanciones']['active']==1)
                        {
                              $validS = Model::validateMultipleScenario($modelsSanciones,'CSanciones');
                              if(!$validS)
                              {
                                        $this->ScenarioD($modelsSanciones);
                                        Yii::$app->session->setFlash('error_validacion');
                                        $mensaje = 'Los datos correspondientes a las Sanciones están incorrectos o incompletos';
                                        $style = 'alert-danger';
                                        $transaction->rollBack();
                                        $flag = false;
                                      }
                                        else
                                           {
                                       
                                            $lengt = 0;
                                            while ($lengt < sizeof($modelsSanciones)-1)
                                            {
                                              $modelSanciones = $modelsSanciones[$lengt];
                                              //$modelSanciones->cuadroid = $model->id;
                                              $lengt++;
                                              
                                               if($flag = $modelSanciones->save(false))
                                                    {
                                                        $modelcuadroSanciones = new CuadroSanciones();
                                                        $modelcuadroSanciones->cuadroid = $model->id;
                                                        $modelcuadroSanciones->sancionesid = $modelSanciones->id;
                                                       $flag = $modelcuadroSanciones->save();

                                                    }


                                                    if(!($flag))
                                                    {
                                                       $transaction->rollBack();
                                                       break;
                                                    }
                                            }
                                            }
                                            //--
                                           /* {
   
                        
                            foreach ($modelsSanciones as $modelSanciones)
                            {
                              
                                if($flag = $modelSanciones->save(false))
                                {
                                    $modelcuadroSanciones = new CuadroSanciones();
                                    $modelcuadroSanciones->cuadroid = $model->id;
                                    $modelcuadroSanciones->sancionesid = $modelSanciones->id;
                                   $flag = $modelcuadroSanciones->save();
                                    
                                }
                                
                                
                                if(!($flag))
                                {
                                   $transaction->rollBack();
                                   break;
                                }
                            }
                        }*/
                        //---
                        }
                        if($flag)
                        {
                         
                             if($_POST['Vehiculo']['active'] == 1)
                                {
                                 
                                 $validV = Model::validateMultipleScenario($modelsVehiculo,'CVehiculo');
                                  //return print_r('valid'.$validV);
                                   if(!$validV)
                                      {
                                        $this->ScenarioD($modelsVehiculo);
                                        Yii::$app->session->setFlash('error_validacion');
                                        $mensaje = 'Los datos correspondientes a los Vehículos están incorrectos o incompletos';
                                        $style = 'alert-danger';
                                        $transaction->rollBack();
                                        $flag = false;
                                      }
                                        else{
                                                
                                       // $removed =   \yii\helpers\ArrayHelper::remove($modelsVehiculo, sizeof($modelsVehiculo));
                                         // return print_r($removed);
                                          
                                            $lengt = 0; 
                                            
                                          //return print_r(sizeof($modelsVehiculo)-1);
                                            while ($lengt < sizeof($modelsVehiculo)-1)
                                            {
                                              $modelVehivulo = $modelsVehiculo[$lengt];
                                              $modelVehivulo->cuadroid = $model->id;
                                              $lengt++;
                                              
                                              if(!$flag = $modelVehivulo->save())
                                              {
                                                       $transaction->rollBack();
                                                       break;
                                                  
                                              }
                                            }
                                           /* foreach ($modelsVehiculo as $modelVehiculo)
                                                {
                                                    $modelVehiculo->cuadroid = $model->id;
                                                    if(!($flag = $modelVehiculo->save()))
                                                    {
                                                       $transaction->rollBack();
                                                       break;
                                                    }
                                                }*/
                                            }
                                }
                        }
                        if($flag)
                        {
                            if($_POST['Armas']['active'] == 1)
                                {
                                    $validA = Model::validateMultipleScenario($modelsArma,'CArma');
                                     if(!$validA)
                                      {
                                        $this->ScenarioD($modelsArma);
                                        Yii::$app->session->setFlash('error_validacion');
                                        $mensaje = 'Los datos correspondientes a las Armas están incorrectos o incompletos';
                                        $style = 'alert-danger';
                                        $transaction->rollBack();
                                        $flag = false;
                                      }
                                        else
                                            {
                                       $lengt = 0;
                                            
                                            while ($lengt < sizeof($modelsArma)-1)
                                            {
                                              $modelArma = $modelsArma[$lengt];
                                              $modelArma->cuadroid = $model->id;
                                              $lengt++;
                                             if(!($flag = $modelArma->save(false)))
                                                    {
                                                       $transaction->rollBack();
                                                       break;
                                                    }
                                            }
                                            }
                                            
                                            
                                            
//--                                            
                                           /* {
                                      
                                                foreach ($modelsArma as $modelArma)
                                                {
                                                    $modelArma->cuadroid = $model->id;
                                                    if(!($flag = $modelArma->save(false)))
                                                    {
                                                       $transaction->rollBack();
                                                       break;
                                                    }
                                                }
                                            }*/ //--
                                }
                        }
                        if($flag)
                        {
                        //  return print_r($modelsPersonaFamiliar);
                            foreach ($modelsPersonaFamiliar as $indexPersonaFamiliar=>$modelPersonaFamliar)
                            {
                            // return print_r($flag."PF");
                                if(!($flag = $modelPersonaFamliar->save(false)))
                             {
                              $transaction->rollBack();
                                  break;   
                             }
                            }
                            //return print_r($_POST['Sancionados']);  
                            // return print_r($modelsSancionados);
                            if($flag)
                            {
                                $viajesExt = 0;
                                $count = 0;
                                $sancionados = 0;
                                $viajes = 0;
                                foreach ($modelsFamiliares as $indexFamiliares => $modelfamiliares)
                                {
                                    
                                    $modelfamiliares->personaCI =$modelsPersonaFamiliar[$count]->CI; 
                            
                                    if($flag = $modelfamiliares->save())
                                    { 
                                         $familiarCuadro = new \frontend\models\CuadroFamiliar();
                                         $familiarCuadro->cuadroid = $model->id;
                                         $familiarCuadro->familiarid = $modelfamiliares->id;
                                         if(!($familiarCuadro->save()))
                                         {
                                              $transaction->rollBack();
                                                      break; 
                                         }

                                                if($modelfamiliares->sancionado == 1)
                                                {
                                                        $modelSancionado = new Sancionados();
                                                        $modelSancionado = $modelsSancionados[$sancionados];
                                                        $modelSancionado->familiarid = $modelfamiliares->id; 

                                                        if(!($flag = $modelSancionado->save()))
                                                        {
                                                          $transaction->rollBack();
                                                          break;       
                                                        }
                                                        $sancionados ++;
                                                }
                                                if($flag && $modelfamiliares->viaje == 1)
                                                {
//                                                 
                                                      if (isset($modelsViajesFamiliares[$indexFamiliares]) && is_array($modelsViajesFamiliares[$indexFamiliares])) {
                                                            foreach ($modelsViajesFamiliares[$indexFamiliares] as $indexViajes => $modelviajesfamiliares) {
                                                                $modelviajesfamiliares->familiarid = $modelfamiliares->id;
                                                                if (!($flag = $modelviajesfamiliares->save(false))) {
                                                                    $transaction->rollBack();
                                                                      break;
                                                                                                                                  }
                                                            }
                                                        }
                                                    
                                                    
                                                }
                                                if($modelfamiliares->residenteExterior == 1)
                                                {
                                                        $modelexterior = new FamiliaresExterior();
                                                        $modelexterior = $modelsFamiliarExterior[$viajesExt];
                                                        $modelexterior->familiarid = $modelfamiliares->id; 

                                                        if(!($flag = $modelexterior->save()))
                                                        {
                                                          $transaction->rollBack();
                                                          break;       
                                                        }
                                                        $viajesExt ++;
                                                }
                                                if($flag)
                                                {
                                                    foreach ($modelsIngresosFamiliares as $modelIngresosFamiliares)
                                                    {
                                                        if($modelIngresosFamiliares->save())
                                                        {
                                                            $cuadroBeneficioIngreso = new CuadroIngresosMonetarios();
                                                            $cuadroBeneficioIngreso->cuadroid = $model->id;
                                                            $cuadroBeneficioIngreso->ingresos_monetariosid = $modelIngresosFamiliares->id;
                                                            if(!($flag = $cuadroBeneficioIngreso->save()))
                                                            {
                                                               $transaction->rollBack();
                                                          break;   
                                                            }
                                                        }
                                                        else{
                                                            $transaction->rollBack();
                                                            break;
                                                        }
                                                    }
                                                }
                                            }else{
                                                $transaction->rollBack();
                                                 break;
                                                }
                                                                                                            
                                          $count++;      
                                     }
                            }
                        
                            if($flag)
                            {
                                foreach ($modelsIdiomas as $modelIdioma) 
                                {
                                  $modelIdioma->preparacion_intelectualid = $modelPreIntel->id;
                                  if(!($modelIdioma->save()))
                                  {
                                      $transaction->rollBack();
                                      break;
                                      
                                  }
                                }
                            }
                          }
                        
 //return print_r($flag.'v2');
                    
                    if ($flag) {
                        
                        $transaction->commit();
            
                       
                        //return print_r(Yii::$app->request->post());
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                     }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
       
          // return print_r($validD.'goto-abajo');
        return $this->render('createcuadro', [
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
            'modelsEscuelaPolitica'=> $modelsEscuelaPolitica,
            
            'modelsEscuelaPoliticaCuadro' =>$modelsEscuelaPoliticaCuadro,
            'modelDirResidencia' =>(empty($modelDirResidencia)) ? [[new Direcciones]] : $modelDirResidencia,
            'modelRecidecias' => (empty($modelRecidecias)) ? [new LugaresResidencia] : $modelRecidecias,
            'modelsTrayectoriaLab' =>(empty($modelsTrayectoriaLab))?[new TrayectoriaLaboral]:$modelsTrayectoriaLab,
            'modelsTrayectoriaEst' =>(empty($modelsTrayectoriaEst))?[new TrayectoriaEstudiantilCentroEstudios]:$modelsTrayectoriaEst,
            'modelsCentroEstudios'=>(empty($modelsCentroEstudios))?[[new CentroEstudios]]:$modelsCentroEstudios,
            'modelsExtanciaExt'=>(empty($modelsExtanciaExt))?[new EstanciaExterior]:$modelsExtanciaExt,
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
            'modelMiliatanciaPolitica'=>(empty($modelMiliatanciaPolitica))? new MiitanciaPoliticCuadro():$modelMiliatanciaPolitica,
    
           
            
        ]);
    }
    public function actionEvaluar()
    {
    {
          if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);   
        }
      /*  if(Yii::$app->user->identity->rolid != "6")
        {               
            throw new \yii\web\ForbiddenHttpException('Usted no tiene permisos para acceder a esta parte del sitios.');
       
        
        }*/
        $searchModel = new CuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('evaluar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    
    }
    
    public function actionPlanDeEvaluacion($param) 
    {
    
        
        
    }
    private function renderError($view)
    {
         return $this->render($view, [
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
            'modelsEscuelaPolitica'=> $modelsEscuelaPolitica,
            
            'modelsEscuelaPoliticaCuadro' =>$modelsEscuelaPoliticaCuadro,
            'modelDirResidencia' =>(empty($modelDirResidencia)) ? [[new Direcciones]] : $modelDirResidencia,
            'modelRecidecias' => (empty($modelRecidecias)) ? [new LugaresResidencia] : $modelRecidecias,
            'modelsTrayectoriaLab' =>(empty($modelsTrayectoriaLab))?[new TrayectoriaLaboral]:$modelsTrayectoriaLab,
            'modelsTrayectoriaEst' =>(empty($modelsTrayectoriaEst))?[new TrayectoriaEstudiantilCentroEstudios]:$modelsTrayectoriaEst,
            'modelsCentroEstudios'=>(empty($modelsCentroEstudios))?[[new CentroEstudios]]:$modelsCentroEstudios,
            'modelsExtanciaExt'=>(empty($modelsExtanciaExt))?[new EstanciaExterior]:$modelsExtanciaExt,
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
    
           
            
        ]);
    }

        /**
     * Updates an existing Cuadro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);   
        }
        if(Yii::$app->user->identity->rolid != "6")
        {               
            throw new \yii\web\ForbiddenHttpException('Usted no tiene permisos para acceder a esta parte del sitios.');
       
        
        }else{
        
        
        $model = $this->findModel($id);
        $modelPersona = $model->personaCI0;
        $modelPreIntel = $model->preparacionIntelectual;
        $modelDirCTA = $model->centroTrabajo->direcciones;
        $modelCentroTrab = $model->centroTrabajo;
        $modelCargoActual = $model->cargo;
        $modelDirectivo = Directivo::findOne(['cuadroid'=>$id]);
        //$modelDirectivo = new Directivo();
        $modelSalud = $model->salud;
        $modelLimitacionesSalud = LimitacionesSalud::findOne(['saludid'=>$modelSalud->id]);
     // return print_r($modelLimitacionesSalud);
        $modelLimitaciones = Limitaciones::findOne(['id'=>$modelLimitacionesSalud['limitacionesid']]);         
        $modelsEnfermedadSalud = EnfermedadSalud::findAll(['saludid'=>$modelSalud->id]);
        $modelsEnfermedad = [new Enfermedad()];
        foreach ($modelsEnfermedadSalud as $modelEnfermedadSalud)
        {
            $modelsEnfermedad[] = $modelEnfermedadSalud->enfermedad;
        }
       
        $modelsTrayectoriaLab = TrayectoriaLaboral::findAll(['cuadroid'=>$model->id]);
        $modelRecidecias = LugaresResidencia::findAll(['cuadroid'=>$model->id]);
        $modelDirResidencia = [[new Direcciones()]];
        foreach ($modelRecidecias as $recidencia)
        {
            $modelDirResidencia[0][]= Direcciones::findOne(['id'=>$recidencia->direccionesid]);
        }
        $modelsIdiomas = PreparacionIntelectualIdiomas::findAll(['preparacion_intelectualid'=>$modelPreIntel->id]);
        $modelTrayectoriaMilitar = $model->trayectoriaMilitar;
        //$modelsTrayecctoriaMiliMili = [new TrayectoriaMilitarMilitancia()];
        $modelsTrayecctoriaMiliMili = TrayectoriaMilitarMilitancia::findOne(['trayectoria_militarid' => $modelTrayectoriaMilitar->id]);
        /*foreach ($modelTrayecctoriaMiliMili as $trayectoria)
        {
            $modelsTrayecctoriaMiliMili[]= $trayectoria;
        }
       */         
        
        $modelsPreparacionMilitar =  PreparacionMilitar::findAll(['trayectoria_militarid'=>$modelTrayectoriaMilitar->id]);
        $modelTrayectoriaEstudiantil = TrayectoriaEstudiantil::findOne(['cuadroid'=>$model->id]);
        $modelsTrayectoriaEst = TrayectoriaEstudiantilCentroEstudios::findAll(['trayectoria_estudiantilid'=>$modelTrayectoriaEstudiantil->id]);
        $modelsCentroEstudios = [[new CentroEstudios()]];
        foreach ($modelsTrayectoriaEst as $centro)
        {
            $modelsCentroEstudios[0][] = $centro->centroEstudios;
        }
        $modelsEscuelaPoliticaCuadro = CuadroEscuelaPolitica::findAll(['cuadroid'=>$model->id]);
        $modelsExtanciaExt = EstanciaExterior::findAll(['cuadroid'=>$model->id]);
        $modelsCondecoraciones = Condecoraciones::findAll(['cuadroid'=>$model->id]);
        $modelsCuadroSanciones = CuadroSanciones::findAll(['cuadroid'=>$model->id]);
        $modelsSanciones = [new Sanciones()];
        foreach ($modelsCuadroSanciones as $sancion)
        {
            $modelsSanciones[] = $sancion->sanciones;
        }
         $modelsVehiculo = Vehiculo::findAll(['cuadroid'=>$model->id]);
         $modelsArma = Armas::findAll(['cuadroid'=>$model->id]);
         $modelsPersonaFamiliar = [new PersonasF()];
         $modelsFamiliares = [new Familiar()];
         $modelsViajesFamiliares = [[new ViajesFamiliares()]];
         $modelsSancionados = [new Sancionados()];
         $modelsFamiliarExterior =[new FamiliaresExterior()];
         $modelsCuadroFamiliar = \frontend\models\CuadroFamiliar::findAll(['cuadroid'=>$model->id]);
         foreach ($modelsCuadroFamiliar as $familiar)
         {
          $modelsPersonaFamiliar[] = $familiar->familiar->personaCI0;   
          $modelsFamiliares[] = $familiar->familiar;
          if($familiar->familiar->viaje == 1)
          {
           $modelsViajesFamiliares[] = ViajesFamiliares::findAll(['familiarid'=>$familiar->familiar->id]);
          }
          if($familiar->familiar->sancionado == 1)
          {
           $modelsSancionados = Sancionados::findAll(['familiarid'=>$familiar->familiar->id]);
          }
          
          if($familiar->familiar->residenteExterior == 1)
          {
            $modelsFamiliarExterior = FamiliaresExterior::findAll(['familiarid'=>$familiar->familiar->id]);
          }
          
         }
         $modelsIngresosFamiliares= [new IngresosMonetarios()];
         $modelsCuadroIngresos = CuadroIngresosMonetarios::findAll(['cuadroid'=>$model->id]);
         foreach ($modelsCuadroIngresos as $ingreso)
         {
             
         $modelsIngresosFamiliares = $ingreso->ingresosMonetarios;
         }
         
//return print_r($modelsSancionados);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
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
            
        ]);}
    }

    /**
     * Deletes an existing Cuadro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);   
        }
        if(Yii::$app->user->identity->rolid != "6")
        {               
            throw new \yii\web\ForbiddenHttpException('Usted no tiene permisos para acceder a esta parte del sitios.');
       
        
        }else{
        
        $this->findModel($id)->updateAttributes(['status'=>0]);

        return $this->redirect(['index']);
        }
        
        }

    /**
     * Finds the Cuadro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cuadro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = Cuadro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionChild() 
    {
        return print_r(($_POST['depdrop_parents']));
        $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $id = end($_POST['depdrop_parents']);
        $list = \frontend\models\Municipio::find()->andWhere(['provinciaid'=>$id])->asArray()->all();
        $selected  = null;
        if ($id != null && count($list) > 0) {
            $selected = '';
            foreach ($list as $i => $municipio) {
                $out[] = ['id' => $municipio['id'], 'name' => $municipio['municipio']];
                if ($i == 0) {
                    $selected = $municipio['id'];
                }
            }
            // Shows how you can preselect a value
            echo Json::encode(['output' => $out, 'selected'=>$selected]);
            return;
        }
    }
    echo Json::encode(['output' => '', 'selected'=>'']);
}
public static function ObtenerLugares($id) 
{
      $model = LugaresResidencia::find()->where(['cuadroId'=>$id])->one();
         return $model;                    
                                       
                                          
    
}

private function ScenarioD($models)
{
    foreach ($models as $model) 
    {
     $model->scenario = 'default';   
    }
}


public static function evaluado($id)
{
   $evaluacioncuadro =  \frontend\models\EvaluacionCuadro::findOne(['cuadroid' => $id,'ultima'=>1]);
   
   if($evaluacioncuadro)
   {
       return $evaluacioncuadro;
   }else{
       return false;
   }
    
}
public static function evaluacionValida($id) 
{
 $evaluacioncuadro =  \frontend\models\EvaluacionCuadro::findOne(['cuadroid' => $id,'ultima'=>1 ]); 
 $fechaevaluacion = new \DateTime($evaluacioncuadro->fecha);
 $today = new \DateTime(date("Y-m-d"));
 $dias = $today->diff($fechaevaluacion);
 
 //return print_r($dias->days); 
 
 if ($dias->days > 180)
 {
     return false;
 }else{return true;}
}

public function actionLists($id) 
{
 $countMunc = \frontend\models\Municipio::find()->where(['provinciaid'=>$id])->count();
 $Muncs = \frontend\models\Municipio::find()->where(['provinciaid'=>$id])->all();
 //return print_r($Muncs);
  if($countMunc>0)
  {
      foreach ($Muncs as $Munc)
      {
          echo "<option value='".$Munc->id."'>".$Munc->municipio."</option>";
      }
  }
else{
  echo "<option> - </option>";  
}
}

public static function nombreCuadro($id) 
   {
    
if($model = CuadroController::findModel($id))
{
    return $model->personaCI0->Nombre." ".$model->personaCI0->primer_apellido." ".$model->personaCI0->segundo_apellido." ";   
}
else {
    return false;
}

    
   }
   
   public function actionCreatewiz()
   {
       $model = new Cuadro();
       $modelPersona = new Persona();
        if ($model->load(Yii::$app->request->post()) && $modelPersona->load(Yii::$app->request->post())) 
        {
            $transaction = \Yii::$app->db->beginTransaction();
          try{
                $modelPersona->CI =  $model->personaCI ;     
              if($modelPersona->save())
              {
           //  $model->personaCI = $modelPersona->CI;
              $model->preparacion_intelectualid =1;
              $model->centro_trabajoid =1;
              $model->cargoid =1;
              $model->fecha_inicio_cargo = date('Y-m-d');
              $model->ubicacion_tiempo_guerra = "sedergsoft";
              $model->saludid = 1;
              $imagenName = trim($model->personaCI);  //guarda el nombre de la bebida para luego renombrar la imagen
            $model->file = UploadedFile::getInstance($model,'foto');
            $model->file->saveAs('uploads/cuadros/fotos/'.$imagenName.'.'.$model->file->extension); //guarda la imagen en la ruta proporcionada
            $model->foto = 'uploads/cuadros/fotos/'.$imagenName.'.'.$model->file->extension; //es asignado al campo imagen modelo bebida la ruta, el nombre y la extencion que que se guardo la imagen
          
             // return print_r($model->getErrors());
                  if($model->save())
                  {
                      $transaction->commit();
                    return $this->redirect(['createrecidencia', 'id' => $model->id]);
                  }else{


                    $transaction->rollBack();
                    ///return print_r($model->errors);
                    return $this->render('createcuadrowizard', [
                        'model' => $model,
                        'modelPersona'=>$modelPersona,
                    ]);
                  }
              
                  
              }else{
                  
                    ///return print_r($modelPersona->errors);
                $transaction->rollBack();
                return $this->render('createcuadrowizard', [
                    'model' => $model,
                    'modelPersona'=>$modelPersona,
                ]);
              }
              
          } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
            
            
        }else{

        return $this->render('createcuadrowizard', [
            'model' => $model,
            'modelPersona'=>$modelPersona,
        ]);
       }
   }
   public function actionCreaterecidencia($id) 
   {
    $model = $this->findModel($id);
    $modelRecidencias = new LugaresResidencia();
   $modelDireResidencia = new Direcciones();
       
        if ($modelDireResidencia->load(Yii::$app->request->post()) && $modelRecidencias->load(Yii::$app->request->post())) 
        {
          $transaction = \Yii::$app->db->beginTransaction();
          try{
              if($modelDireResidencia->save())
              {
                  $modelRecidencias->direccionesid = $modelDireResidencia->id;
                  $modelRecidencias->actual = 1;
                  $modelRecidencias->cuadroid = $model->id;
                 // return print_r($_POST);
                  if($modelRecidencias->save())
                  {
                      $transaction->commit();
                    return $this->redirect(['createpreparacionintelectual', 'id' => $model->id]);
                 
                  }else{
                      $transaction->rollBack();
                      return print_r($modelRecidencias->errors);
                      
                  return $this->render('createrecidenciawizard', [
                    'model' => $model,
                    'modelRecidencias'=>$modelRecidencias,
                'modelDireResidencia'=>$modelDireResidencia,]);
                      
                  }
                      
                  
              }else{
                      return print_r($modelDireResidencia->errors);
                  $transaction->rollBack();
                  return $this->render('createrecidenciawizard', [
                    'model' => $model,
                    'modelRecidencias'=>$modelRecidencias,
                'modelDireResidencia'=>$modelDireResidencia,
                ]);
              }
              
              
          }
          catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }else{
            return $this->render('createrecidenciawizard', [
                    'model' => $model,
                    'modelRecidencias'=>$modelRecidencias,
                'modelDireResidencia'=>$modelDireResidencia,
                ]); 
        }
    
   }
   public function actionCreatepreparacionintelectual($id)
   {
       $model = $this->findModel($id);
       $model->ubicacion_tiempo_guerra = "";
       $modelPreIntel = new PreparacionIntelectual();
       $modelMiliatanciaPolitica = new MiitanciaPoliticCuadro();
       $modelsIdiomas = [new PreparacionIntelectualIdiomas];
       
               if ($model->load(Yii::$app->request->post()) && 
                   $modelPreIntel->load(Yii::$app->request->post())&& 
                   $modelMiliatanciaPolitica->load(Yii::$app->request->post())) 
        {
                    $modelsIdiomas = Model::createMultiple(PreparacionIntelectualIdiomas::classname()); //metodo que permite crear multiples instacias de un modelo
                     Model::loadMultiple($modelsIdiomas, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
                     $validI = Model::validateMultiple($modelsIdiomas);
                     
                     if($validI )
                     {
                       $transaction = \Yii::$app->db->beginTransaction();
          try{  
                      
                        if($modelPreIntel->save())
                        {
              
                               foreach ($modelsIdiomas as $modelIdioma) 
                                {
                                  $modelIdioma->preparacion_intelectualid = $modelPreIntel->id;
                                  if(!($modelIdioma->save()))
                                  {
                                      
                                      $transaction->rollBack();
                                      return $this->render('createpreparacionintelectualwizard', [
                                                            'model' => $model,
                                                            'modelPreIntel'=>$modelPreIntel,
                                                            'modelMiliatanciaPolitica'=>$modelMiliatanciaPolitica,
                                                             'modelsIdiomas'=>(empty($modelsIdiomas))?[new PreparacionIntelectualIdiomas()]:$modelsIdiomas,
                                                        ]); 
                                      break;
                                      
                                  }
                                }
                                $model->preparacion_intelectualid = $modelPreIntel->id;
                                if($model->save())
                                {
                                    
                                $transaction->commit();
                                return $this->redirect(['createdatoslaborales', 'id' => $model->id]);
                                }else{
                                      $transaction->rollBack();
                                      return $this->render('createpreparacionintelectualwizard', [
                                                            'model' => $model,
                                                            'modelPreIntel'=>$modelPreIntel,
                                                            'modelMiliatanciaPolitica'=>$modelMiliatanciaPolitica,
                                                             'modelsIdiomas'=>(empty($modelsIdiomas))?[new PreparacionIntelectualIdiomas()]:$modelsIdiomas,
                                                        ]); 
                                    
                                }
                 
                                
                        }else{
                            $transaction->rollBack();
                                      return $this->render('createpreparacionintelectualwizard', [
                                                            'model' => $model,
                                                            'modelPreIntel'=>$modelPreIntel,
                                                            'modelMiliatanciaPolitica'=>$modelMiliatanciaPolitica,
                                                             'modelsIdiomas'=>(empty($modelsIdiomas))?[new PreparacionIntelectualIdiomas()]:$modelsIdiomas,
                                                        ]); 
                        }    
                                  
                                    
                     }
                    catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } 
                   
        }else{
            return $this->render('createpreparacionintelectualwizard', [
                    'model' => $model,
                    'modelPreIntel'=>$modelPreIntel,
                    'modelMiliatanciaPolitica'=>$modelMiliatanciaPolitica,
                     'modelsIdiomas'=>(empty($modelsIdiomas))?[new PreparacionIntelectualIdiomas()]:$modelsIdiomas,
                ]); 
        }
        }
        else{
            return $this->render('createpreparacionintelectualwizard', [
                    'model' => $model,
                    'modelPreIntel'=>$modelPreIntel,
                    'modelMiliatanciaPolitica'=>$modelMiliatanciaPolitica,
                     'modelsIdiomas'=>(empty($modelsIdiomas))?[new PreparacionIntelectualIdiomas()]:$modelsIdiomas,
                ]); 
        }
        
   
   }
   
   public function actionCreatedatoslaborales($id) 
   {
     $model = $this->findModel($id);
     $modelCentroTrab = new CentroTrabajo();
     $modelDirCTA = new Direcciones();
     $modelCargoActual  = new Cargo();
     $modelDirectivo = new Directivo();
     
    if($model->load(Yii::$app->request->post())&&
       $modelCentroTrab->load(Yii::$app->request->post())&&
       $modelDirCTA->load(Yii::$app->request->post())&&
       $modelDirectivo->load(Yii::$app->request->post())&&
       $modelCargoActual->load(Yii::$app->request->post())
    )
    {
      $transaction = \Yii::$app->db->beginTransaction();
          try{
              if($modelDirCTA->save())
              {
                $modelCentroTrab->direccionesid = $modelDirCTA->id;
                if($modelCargoActual->save()&&$modelCentroTrab->save())
                {
                    $model->cargoid = $modelCargoActual->id;
                    $model->centro_trabajoid = $modelCentroTrab->id;
                    if($modelDirectivo->active == 1) //compruebo si tiene trayectioria como directivo 
                          {
                                $modelDirectivo->scenario = 'CDirectivo'; //pongo el escenario crear directivo en el modelo directivo
                                $validD = $modelDirectivo->validate(); //valido el modelo dirctivo
                                if($validD)
                                {
                                  
                                    $modelDirectivo->cuadroid = $model->id;
                                    if(!$flag = $modelDirectivo->save())
                                    {
                                     $modelDirectivo->scenario = 'default';
                                        $transaction->rollBack();
                                                  
                                    }
                                }
                                else{
                                   // return print_r($modelDirectivo->errors);
                                         Yii::$app->session->setFlash('error_validacion');
                                          $modelDirectivo->scenario = 'default';
                                        $transaction->rollBack();
                                        $modelDirectivo->active = 0;
                                        return $this->render('createdatoslaboraleswizard',[
                                            'model'=>$model,
                                            'modelCentroTrab'=>$modelCentroTrab,
                                            'modelDirCTA'=>$modelDirCTA,
                                            'modelCargoActual'=>$modelCargoActual,
                                            'modelDirectivo'=>$modelDirectivo,
                                        ]);
                                    }
                           }      
                    if($model->save())
                    {
                         $transaction->commit();
                                return $this->redirect(['createestadosalud', 'id' => $model->id]);
                              
                    }else{
                       // return print_r($model->errors);
                        $modelDirectivo->active = 0;
                          $transaction->rollBack();
                            return $this->render('createdatoslaboraleswizard',[
                                'model'=>$model,
                                'modelCentroTrab'=>$modelCentroTrab,
                                'modelDirCTA'=>$modelDirCTA,
                                'modelCargoActual'=>$modelCargoActual,
                                'modelDirectivo'=>$modelDirectivo,
                            ]);
                    }
                    
                }else{
                    //return print_r($modelCargoActual);
                    $modelDirectivo->active = 0;
                      $transaction->rollBack();
                        return $this->render('createdatoslaboraleswizard',[
                            'model'=>$model,
                            'modelCentroTrab'=>$modelCentroTrab,
                            'modelDirCTA'=>$modelDirCTA,
                            'modelCargoActual'=>$modelCargoActual,
                            'modelDirectivo'=>$modelDirectivo,
                        ]);
                    
                    }
              }else{
                 // return print_r($modelDirCTA);
                  $modelDirectivo->active = 0;
                  $transaction->rollBack();
                    return $this->render('createdatoslaboraleswizard',[
                        'model'=>$model,
                        'modelCentroTrab'=>$modelCentroTrab,
                        'modelDirCTA'=>$modelDirCTA,
                        'modelCargoActual'=>$modelCargoActual,
                        'modelDirectivo'=>$modelDirectivo,
                    ]);
                  }
              
          } catch (Exception $ex) {
              $transaction->rollBack();
          }
        
    }else{
        $modelDirectivo->active = 0;
        return $this->render('createdatoslaboraleswizard',[
            'model'=>$model,
            'modelCentroTrab'=>$modelCentroTrab,
            'modelDirCTA'=>$modelDirCTA,
            'modelCargoActual'=>$modelCargoActual,
            'modelDirectivo'=>$modelDirectivo,
        ]);
    }
   }
   
   public function actionCreateestadosalud($id) 
   {
     $model = $this->findModel($id);
     $modelsEnfermedad = [new Enfermedad];
     $modelSalud = new Salud();
     $modelLimitaciones = new Limitaciones();
     $modelLimitacionSalud = new LimitacionesSalud();
     if($modelSalud->load(Yii::$app->request->post())&&$modelLimitaciones->load(Yii::$app->request->post()))
     {
         $modelsEnfermedad = Model::createMultiple(Enfermedad::classname()); //metodo que permite crear multiples instacias de un modelo
         Model::loadMultiple($modelsEnfermedad, Yii::$app->request->post()); //metodo que carga las multiples intancias del modelo creado
         $valid = Model::validateMultiple($modelsEnfermedad); 
             //return print_r($modelSalud->getErrors());
         if($valid && $model->validate())
         {
         $transaction = \Yii::$app->db->beginTransaction();
          try{ 
              if(!$flag = $modelSalud->save())
              {
                $transaction->rollBack();  
                 return $this->render('createestadosaludwizard',[
                         'model'=>$model,
                         'modelSalud'=>$modelSalud,
                         'modelLimitaciones' =>$modelLimitaciones,

                         'modelsEnfermedad'=>(empty($modelsEnfermedad))?[new Enfermedad()]:$modelsEnfermedad,
                     ]);  
              }
              if(!$flag = $modelLimitaciones->save())
              {
               $transaction->rollBack();  
                 return $this->render('createestadosaludwizard',[
                         'model'=>$model,
                         'modelSalud'=>$modelSalud,
                         'modelLimitaciones' =>$modelLimitaciones,

                         'modelsEnfermedad'=>(empty($modelsEnfermedad))?[new Enfermedad()]:$modelsEnfermedad,
                     ]);   
              }else{
              $modelLimitacionSalud->saludid = $modelSalud->id;
              $modelLimitacionSalud->limitacionesid=$modelLimitaciones->id;
               $flag = $modelLimitacionSalud->save();
             
              
              }
             foreach ($modelsEnfermedad as $Enfermedad) 
                                {


                                if (! ($flag = $Enfermedad->save(false))) { //si hubo algun error el el proceso de guardado revierto el proceso

                                        $transaction->rollBack();
                                         break;
                                        }

                                $modelEnfermedadSalud = new EnfermedadSalud();
                                $modelEnfermedadSalud->saludid = $modelSalud->id;
                                $modelEnfermedadSalud->enfermedadid = $Enfermedad->id;
                                $modelEnfermedadSalud->save();    

                            }
                            if($flag)
                            {
                             $model->saludid = $modelSalud->id;
                             if($model->save())
                             {
                                 
                             $transaction->commit();
                               return $this->redirect(['createtrayectoriaestudiantil', 'cuadroid' => $model->id]);
                             }else{
                                    return $this->render('createestadosaludwizard',[
                                     'model'=>$model,
                                     'modelSalud'=>$modelSalud,
                                     'modelLimitaciones' =>$modelLimitaciones,

                                     'modelsEnfermedad'=>(empty($modelsEnfermedad))?[new Enfermedad()]:$modelsEnfermedad,
                                 ]); 
                             }
                             
                            }
                            else{
                                
                                    return $this->render('createestadosaludwizard',[
                                     'model'=>$model,
                                     'modelSalud'=>$modelSalud,
                                     'modelLimitaciones' =>$modelLimitaciones,

                                     'modelsEnfermedad'=>(empty($modelsEnfermedad))?[new Enfermedad()]:$modelsEnfermedad,
                                 ]); 
                            }
             } catch (Exception $ex) {
                                    $transaction->rollBack();
                                  }
         }else{
            return $this->render('createestadosaludwizard',[
             'model'=>$model,
             'modelSalud'=>$modelSalud,
             'modelLimitaciones' =>$modelLimitaciones,
             
             'modelsEnfermedad'=>(empty($modelsEnfermedad))?[new Enfermedad()]:$modelsEnfermedad,
         ]);  
         }
     }else{
         return $this->render('createestadosaludwizard',[
             'model'=>$model,
             'modelSalud'=>$modelSalud,
             'modelLimitaciones' =>$modelLimitaciones,
             
             'modelsEnfermedad'=>(empty($modelsEnfermedad))?[new Enfermedad()]:$modelsEnfermedad,
         ]);
     }
         
     
       
   }
  
    public function actionCreatetrayectoriaestudiantil($cuadroid)
    {
        $model = new TrayectoriaEstudiantilCentroEstudios();
        $cuadro = $this->findModel($cuadroid);
        $modelCentroEstudios = new \frontend\models\CentroEstudios();
        $modelTrayectoriaEst = new \frontend\models\TrayectoriaEstudiantil();
        if ($model->load(Yii::$app->request->post())&&$modelCentroEstudios->load(Yii::$app->request->post()))
            {
            $modelTrayectoriaEst->cuadroid = $cuadroid;
            $modelTrayectoriaEst->save();
            $model->trayectoria_estudiantilid=$modelTrayectoriaEst->id;
            $modelCentroEstudios->save();
            $model->centro_estudiosid=$modelCentroEstudios->id;
            if($model->save())
            {
                
            return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
            }
            else{
            return $this->render('createcentroestudioswizard', [
            'model' => $model,
            'modelCentroEstudios'=>$modelCentroEstudios,
            'cuadro'=>$cuadro,
            
            
        ]);     
            }
            }
        return $this->render('createcentroestudioswizard', [
            'model' => $model,
            'modelCentroEstudios'=>$modelCentroEstudios,
            'cuadro'=>$cuadro,
            
            
        ]);
    }
    
    
  

}
