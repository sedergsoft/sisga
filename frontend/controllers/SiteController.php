<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use kartik\mpdf\Pdf;
use frontend\models\User;
use PhpOffice\PhpWord\PhpWord;
use frontend\controllers\FondoTiempoController;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

       public function actionName()
    {
        return print_r(Yii::$app->session->name);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    
    public function actionGenerar()
    {
       $searchModelObjetivo = new \frontend\models\ObjetivoSearch();
        $dataProviderObjetivo = $searchModelObjetivo->search(Yii::$app->request->queryParams);
        $dataProviderObjetivo->query->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC]);
        $searchModelCriteriomedida = new \frontend\models\CriteriomedidaSearch();
        $dataProviderCriteriomedida = $searchModelCriteriomedida->search(Yii::$app->request->queryParams);
        $dataProviderCriteriomedida->query->andFilterWhere(['Status'=>1]);
      
        
    
         return $this->render('generar', [
            'searchModelObjetivo' => $searchModelObjetivo,
            'dataProviderObjetivo' => $dataProviderObjetivo,
            'searchModelCriteriomedida'=>$searchModelCriteriomedida,
            'dataProviderCriteriomedida'=>$dataProviderCriteriomedida,
    
        ]);
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) 
         {
           
            if ( $model->login()!= false)
            {
                $this->conectarUser();
            //return print_r($users);
            return $this->goBack();
           }
           else{
               $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
           }
           
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        
        $this->desconectarUser();
        Yii::$app->user->logout();    
        

        return $this->goHome();
    }
       public function actionErrores($message,$name)
    {
        return $this->render('errores',[
            'message' => $message,
            'name'=>$name,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
  
      public function actionRecuperar()
    {
        if (\Yii::$app->user->isGuest) 
       {
        $model = new \frontend\models\ControlUsuario();
        
        if($model->load(Yii::$app->request->post()))
        {
          return $this->redirect(['control-usuario/comprobar','username'=>$model->user]);  
        }
        return $this->render('recuperar', [
                'model' => $model,
         ]);
            
        
        }
    
    }

    
    
    
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionCreateuser()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())&& $user = $model->signup()) 
           {

              return $this->redirect(['/user/index']);
                /*  if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
               }*/
            }
            else{
                return $this->render('createuser', [
            'model' => $model,
            ]);
        }
    
    }
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    /*
    public function actionPdf() 
    {
     
        $objetivos = \frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC])->all();
        $criterios = \frontend\models\Criteriomedida::find()->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC])->all();
        $direciones = \frontend\models\Direccion::find()->where(['status'=>1])->all();
        $indicadores = \frontend\models\IndicadoresGestion::find()->orderBy(['orden' => SORT_ASC])->all();
        $tope = \frontend\models\TopeIndicador::find()->all();
        $sentido = \frontend\models\Sentido::find()->all();
        $topec = \frontend\models\Tope::find()->all();
        $evaluacionCriterio = \frontend\models\Evaluacion::find()->where(['status'=>1])->andWhere(['actual'=>1])->all();
        $evaluacionIndicador = \frontend\models\Cumplimiento::find()->where(['status'=>1])->andWhere(['actual'=>1])->all();
        $periodos = \frontend\models\Periodo::find()->all();
        $user = \common\models\User::find()->all();
        $estado = \frontend\models\EstadoCumplimiento::find()->all();
        
        $datosobjetivos = \yii\helpers\ArrayHelper::toArray($objetivos);
        $datoscriterios = \yii\helpers\ArrayHelper::toArray($criterios);
        $datosdireciones = \yii\helpers\ArrayHelper::toArray($direciones);
        $datosIndicadores = \yii\helpers\ArrayHelper::toArray($indicadores);
        $datostopec = \yii\helpers\ArrayHelper::toArray($topec);
        $datostope = \yii\helpers\ArrayHelper::toArray($tope);
        $datossentido = \yii\helpers\ArrayHelper::toArray($sentido);
        $datosevaluacionCriterio = \yii\helpers\ArrayHelper::toArray($evaluacionCriterio);
        $datosevaluacionIndicador = \yii\helpers\ArrayHelper::toArray($evaluacionIndicador);
        $datosperiodos = \yii\helpers\ArrayHelper::toArray($periodos);
        $datosuser = \yii\helpers\ArrayHelper::toArray($user);
        $datosestado = \yii\helpers\ArrayHelper::toArray($estado);
    
// return print_r($evaluacionCriterio); 
        $anexostabla = EvaluacionController::buscarAnexotabla($evaluacionCriterio);
        $anexocriterioid[] = array();
        $anexotablasindicador = CumplimientoController::buscarAnexotabla($evaluacionIndicador);
        $anexoindicadorid[] = array();
      
        if($anexostabla != false)
                {
                foreach ($anexostabla as $evaluacionanexo) 
                    {
                    $anexocriterioid[$evaluacionanexo->evaluacionid] =  $this->obenerdatos($evaluacionanexo) ;
                    }
                } 
         if($anexotablasindicador != false)
                {
                foreach ($anexotablasindicador as $indicadoranexo) 
                    {
                    $anexoindicadorid[$indicadoranexo->cumplimientoid] =  $this->obenerdatos($indicadoranexo) ;
                    }
                }        
        
               // return print_r($anexocriterioid);
        
        $content = $this->renderPartial('_libropdfdir', [
            'datosobjetivos' => $datosobjetivos,
            'datoscriterios' => $datoscriterios,
            'datosdireciones'=> $datosdireciones,
            'datosIndicadores'=>$datosIndicadores,
            'datossentido'=>$datossentido,
            'datostope'=>$datostope,
            'datostopec'=>$datostopec,
            'datosevaluacionIndicador'=>$datosevaluacionIndicador,
            'datosevaluacionCriterio'=>$datosevaluacionCriterio,
            'datosperiodos'=>$datosperiodos,
            'datosuser'=>$datosuser,
            'datosestado' => $datosestado,
            'anexocriterioid'=>$anexocriterioid,
            'anexoindicadorid'=>$anexoindicadorid,
           
    
    ]);
       
          



        $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_LANDSCAPE, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        'defaultFontSize'=>60,
        // format content from your own css file if needed or use the
       // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => 'td{font-size:45px},th{font-size:45px},div.panel-heading{font-size:45px},.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 45px;
    color: inherit;
}

sisga.css:144
h1',   
        // format content from your own css file if needed or use the
       'filename' => 'Informe Estadistico Gestion - '.date('M, Y'),
        'options' => ['title' => "OSDE GA"],
         // call mPDF methods on the fly
        
        'methods' => [ 
            'SetHeader'=>["OSDE Grupo Alimentos - ".date('M, Y')], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
        
       if(EvaluacionController::buscarAnexo($evaluacionCriterio)!= false)
        {
         $anexos = EvaluacionController::buscarAnexo($evaluacionCriterio);
       //  return print_r($anexos);
         foreach ($anexos as $anexo) 
            {
            
            $pdf->addPdfAttachment($anexo['nombre'],'Anexo del Criterio de Medida '.$anexo['criterio'],''); 
         
            }
        }
        
         if(CumplimientoController::buscarAnexo($evaluacionIndicador)!= false)
        {
         $anexos1 = CumplimientoController::buscarAnexo($evaluacionIndicador);
        // return print_r($anexos1);
         foreach ($anexos1 as $anexo) 
            {
 
            $pdf->addPdfAttachment($anexo['nombre'],'Anexo del Indicador '.$anexo['indicador'],''); 
            }
        }
        return $pdf->render();   
    
 
   
   
    }
    */
    /*
    public function actionPdfmes() 
    {
     
        if($_POST['Mes'])
        {
            $mes = $_POST['Mes'];
            $year = $_POST['Year'];
            //$mes = Yii::$app->formatter->
            //return print_r($mes);
        $objetivos = \frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC])->all();
        $criterios = \frontend\models\Criteriomedida::find()->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC])->all();
        $direciones = \frontend\models\Direccion::find()->all();
        $indicadores = \frontend\models\IndicadoresGestion::find()->orderBy(['orden' => SORT_ASC])->all();
        $tope = \frontend\models\TopeIndicador::find()->all();
        $sentido = \frontend\models\Sentido::find()->all();
        $topec = \frontend\models\Tope::find()->all();
        $evaluacionCriterio = \frontend\models\Evaluacion::find()->where(['status'=>1])->andFilterWhere(['MONTH(fechacreado)' => $mes])->all();
        $evaluacionIndicador = \frontend\models\Cumplimiento::find()->where(['status'=>1])->andFilterWhere(['MONTH(fecha)' => $mes])->all();
        $periodos = \frontend\models\Periodo::find()->all();
        $user = \common\models\User::find()->all();
        $estado = \frontend\models\EstadoCumplimiento::find()->all();
        
        $datosobjetivos = \yii\helpers\ArrayHelper::toArray($objetivos);
        $datoscriterios = \yii\helpers\ArrayHelper::toArray($criterios);
        $datosdireciones = \yii\helpers\ArrayHelper::toArray($direciones);
        $datosIndicadores = \yii\helpers\ArrayHelper::toArray($indicadores);
        $datostopec = \yii\helpers\ArrayHelper::toArray($topec);
        $datostope = \yii\helpers\ArrayHelper::toArray($tope);
        $datossentido = \yii\helpers\ArrayHelper::toArray($sentido);
        $datosevaluacionCriterio = \yii\helpers\ArrayHelper::toArray($evaluacionCriterio);
        $datosevaluacionIndicador = \yii\helpers\ArrayHelper::toArray($evaluacionIndicador);
        $datosperiodos = \yii\helpers\ArrayHelper::toArray($periodos);
        $datosuser = \yii\helpers\ArrayHelper::toArray($user);
        $datosestado = \yii\helpers\ArrayHelper::toArray($estado);
        
        $anexostabla = EvaluacionController::buscarAnexotabla($evaluacionCriterio);
        $anexocriterioid[] = array();
        $anexotablasindicador = CumplimientoController::buscarAnexotabla($evaluacionIndicador);
        $anexoindicadorid[] = array();
// return print_r($evaluacionCriterio); 
        if($anexostabla != false)
                {
                foreach ($anexostabla as $evaluacionanexo) 
                    {
                    $anexocriterioid[$evaluacionanexo->evaluacionid] =  $this->obenerdatos($evaluacionanexo) ;
                    }
                } 
         if($anexotablasindicador != false)
                {
                foreach ($anexotablasindicador as $indicadoranexo) 
                    {
                    $anexoindicadorid[$indicadoranexo->cumplimientoid] =  $this->obenerdatos($indicadoranexo) ;
                    }
                }        
        
               // return print_r($anexocriterioid);
        
        $content = $this->renderPartial('_libropdf', [
            'datosobjetivos' => $datosobjetivos,
            'datoscriterios' => $datoscriterios,
            'datosdireciones'=> $datosdireciones,
            'datosIndicadores'=>$datosIndicadores,
            'datossentido'=>$datossentido,
            'datostope'=>$datostope,
            'datostopec'=>$datostopec,
            'datosevaluacionIndicador'=>$datosevaluacionIndicador,
            'datosevaluacionCriterio'=>$datosevaluacionCriterio,
            'datosperiodos'=>$datosperiodos,
            'datosuser'=>$datosuser,
            'datosestado' => $datosestado,
            'anexocriterioid'=>$anexocriterioid,
            'anexoindicadorid'=>$anexoindicadorid,
           
    
    ]);
       
          
  //return print_r($anexostabla);
     
   /*if($anexostabla != NULL)
   {
    foreach ($anexostabla as $evaluacionanexo) 
    {
     $content = $content.$this->obenerdatos($evaluacionanexo);
        
    }
   } */
   
    
   


/*        $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_LANDSCAPE, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        'defaultFontSize'=>60,
        // format content from your own css file if needed or use the
       // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => 'td{font-size:45px},th{font-size:45px},div.panel-heading{font-size:45px}',    
        // format content from your own css file if needed or use the
       'filename' => 'Informe Estadistico Gestion - '.date('M, Y'),
       'options' => ['title' => "OSDE GA"],
         // call mPDF methods on the fly
        
        'methods' => [ 
            'SetHeader'=>["OSDE Grupo Alimentos - ".date('M, Y')], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
       if(EvaluacionController::buscarAnexo($evaluacionCriterio)!= false)
        {
         $anexos = EvaluacionController::buscarAnexo($evaluacionCriterio);
       //  return print_r($anexos);
         foreach ($anexos as $anexo) 
            {
            
            $pdf->addPdfAttachment($anexo['nombre'],'Anexo del Criterio de Medida '.$anexo['criterio'],''); 
         
            }
        }
        
         if(CumplimientoController::buscarAnexo($evaluacionIndicador)!= false)
        {
         $anexos1 = CumplimientoController::buscarAnexo($evaluacionIndicador);
        // return print_r($anexos1);
         foreach ($anexos1 as $anexo) 
            {
 
            $pdf->addPdfAttachment($anexo['nombre'],'Anexo del Indicador '.$anexo['indicador'],''); 
            }
        }
      
        return $pdf->render();   
    
 
   
        }  
    }
    */
    public static function notificaciones() //cuenta la cantidad de notificaciones que tienen los usuarios directores
    {
        return SiteController::notificarcriterio()+ SiteController::notificarindicador();   
    }
     public static function notificacionescuadros() //cuenta la cantidad de notificaciones que tienen los usuarios evaluadores
    {
        return SiteController::notificarevaluarcuadro();   
    }
    public static function notificarcriterio()
    {
       $dataProvider = new \yii\data\SqlDataProvider([
    'sql' => 'SELECT evaluacion.id,evaluacion.valor_vreal, evaluacion.fechacreado, evaluacion.direccionid, evaluacion.criteriomedidaid, evaluacion.estado, evaluacion.periodo,evaluacion.userid,evaluacion.observaciones 
                FROM evaluacion INNER JOIN criteriomedida ON evaluacion.criteriomedidaid = criteriomedida.id
                WHERE criteriomedida.direccionid = :direccionid AND  evaluacion.estado = 1 AND evaluacion.status = 1 AND criteriomedida.evaluado = 1 AND evaluacion.actual= 1 ',
    'params' => [':direccionid' =>  UserController::findmodel(\Yii::$app->user->getId())->direccionid]
   

   ]);
   return $dataProvider->count;
    }
    public static function notificarevaluarcuadro()
    {
       $dataProvider = new \yii\data\SqlDataProvider([
    'sql' => '	SELECT `plan_evaluacion`.* FROM `plan_evaluacion` LEFT JOIN `cuadro` ON cuadro.id = plan_evaluacion.idcuadro WHERE ((`plan_evaluacion`.`status`=0) AND (`cuadro`.`status`=1)) AND (`idevaluador`=:userid) ',
    'params' => [':userid' =>  \Yii::$app->user->getId()]
   

   ]);
   return $dataProvider->count;
    }
    public static function notificarindicador() 
    {
    $dataProvider = new \yii\data\SqlDataProvider([
    'sql' => 'SELECT cumplimiento.id,cumplimiento.indicadores_gestionid, cumplimiento.valor, cumplimiento.userid, cumplimiento.observaciones, cumplimiento.estado_cumplimientoid, cumplimiento.fecha 
                FROM cumplimiento INNER JOIN indicadores_gestion ON cumplimiento.indicadores_gestionid = indicadores_gestion.id
                WHERE indicadores_gestion.direccionid = :direccionid AND  cumplimiento.estado_cumplimientoid = 1 AND  cumplimiento.status= 1 AND cumplimiento.actual= 1 AND indicadores_gestion.evaluado = 1 AND cumplimiento.actual= 1 AND YEAR(cumplimiento.fecha) = :anno AND (MONTH(cumplimiento.fecha) = :periodo OR MONTH(cumplimiento.fecha) = :periodoanterior)  ',
           'params' => [ ':periodo'=> date('m'),
               ':periodoanterior'=> date('m')-1,
                ':anno'=> date('Y'),
               ':direccionid' =>  UserController::findmodel(\Yii::$app->user->getId())->direccionid]
   

   ]);
   return $dataProvider->count;    
    }
    public static function formarnotificaciones() 
    {
        $notificaciones = "";
        if(SiteController::notificarcriterio()> 0 && SiteController::notificarindicador()> 0)
        {
            $notificaciones ='<div><div class="popover-footer" style="text-align: left;"> <a href="'.\yii\helpers\Url::to(['/evaluacion/index']) .'" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> '.SiteController::notificarcriterio().' criterios sin certificar 
            
          </a>
         </div>
         <div class="popover-footer" style="text-align: left;">
            <a href="'.\yii\helpers\Url::to(['/cumplimiento/index']) .'" class="dropdown-item">
            <i class="fa fa-users mr-2"></i> '.SiteController::notificarindicador().' Indicadores sin certificar 
         
          </a>
          </div>
          </div>'
          ;       
        }
        if(SiteController::notificarcriterio()== 0 && SiteController::notificarindicador()> 0)
        {
            $notificaciones ='
          <a href="'.\yii\helpers\Url::to(['/cumplimiento/index']) .'"  class="dropdown-item">
            <i class="fa fa-users mr-2"></i> '.SiteController::notificarindicador().' Indicador(es) sin certificar 
           
          </a>'
          ;       
        }
        if(SiteController::notificarcriterio()> 0 && SiteController::notificarindicador()== 0)
        {
            $notificaciones =' <a href="'.\yii\helpers\Url::to(['/evaluacion/index']) .'" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> '.SiteController::notificarcriterio().' criterio(s) sin certificar 
            </a>'
          ;       
        }
    
        return $notificaciones;
        }
    public static function formarnotificacionescuadro() 
    {
        $notificaciones = "";
        if(SiteController::notificarevaluarcuadro()> 0 )
        {
            $notificaciones ='<div><div class="popover-footer" style="text-align: left;"> <a href="'.\yii\helpers\Url::to(['/plan-evaluacion/indexuser']) .'" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> '.SiteController::notificarevaluarcuadro().' cuadro(s) por Evaluar 
            
          </a>
         </div>'
       
          ;       
        }
     
    
        return $notificaciones;
        }
        
        public static function haynotificaciones() 
        {
         if(SiteController::notificarcriterio()== 0 && SiteController::notificarindicador()== 0)
        { 
         return false;
         }
         return TRUE;
        }
        
        public function conectarUser() 
    {
     
             $users = User::findOne(Yii::$app->user->getId());
            $users->updateAttributes(['conectado'=>1]); 
      
    }
  protected function desconectarUser() 
    {
        $users = User::findOne(Yii::$app->user->getId());
            $users->updateAttributes(['conectado'=>0]);  
            
    }
 
    
    public function obenerdatos($evaluacionanexo) 
    {
       // return print_r($evaluacionanexo);
 switch ($evaluacionanexo->anexoid)
     {
     case 1 : 
                   {
         
                    $searchModel1 = new \frontend\models\VentasSearch();
                    $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                    $dataProvider1->query->andFilterWhere(['anexoid'=> $evaluacionanexo->id]);
                    $dataProvider1->pagination = FALSE;
                    
                    $venta = Ventas::findOne(['anexoid'=>$id]);
                 
                    $content1=$this->renderPartial('..\ventas\indexpdf', [
                                                    'searchModel' => $searchModel1,
                                                    'dataProvider' => $dataProvider1,
                                                    'venta' =>$venta,    
                                                   ]);         
         
                    
                                                   return $content1;
                 
         
                   
                  break;
                   }
     
    case 2 :       $searchModel = new \frontend\models\ReclamacionesSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id])->orderBy(['tipo_reclamacion'=>'ASC']);
                    $dataProvider->pagination = FALSE;
        $content1 = $this->renderPartial('..\reclamaciones\indexpdf', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
        
        
        return $content1;
                   {
                  
        
                  break;
                   }
     case 3 : 
                 $searchModel1 = new \frontend\models\VentasSearch();
                    $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                    $dataProvider1->query->andFilterWhere(['anexoid'=> $evaluacionanexo->id]);
                    $dataProvider1->pagination = FALSE;
                    
                    $venta = Ventas::findOne(['anexoid'=>$evaluacionanexo->id]);
                 
                    $content1=$this->renderPartial('..\ventas\indexpdf', [
                                                    'searchModel' => $searchModel1,
                                                    'dataProvider' => $dataProvider1,
                                                    'venta' =>$venta,    
                                                   ]);         
         
                    
                                                   return $content1;
                 
         
                   
                   {
                  
                  break;
                   }
     case 4 : 
                   {
                  
                  break;
                   }
     case 6 :  
                $searchModel = new \frontend\models\InformacionLaboratoriosSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['anexoid'=> $evaluacionanexo->id]);
                $dataProvider->pagination = FALSE;
                $content1 = $this->renderPartial('..\Informacion-laboratorios\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider
            
         ]);
         return $content1;
             
                   {
                  
                  break;
                   }
     case 7 :           $searchModel = new \frontend\models\CuentasSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                        $dataProvider->pagination = FALSE;
                        $tipocuenta = Cuentas::findOne(['anexoid'=>$evaluacionanexo->id]);

                        $content1 =  $this->renderPartial('..\cuentas\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'tipocuenta'=>$tipocuenta,
                                                        ]);
                        return $content1;   
                   {
                  
                  break;
                   }
     case 8 : 
                    $searchModel = new \frontend\models\VariacionGastosSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id,'periodo'=>'2018-04'])->orderBy(['periodo'=>'ASC']);
                    $dataProvider->pagination = FALSE;

                    $content1 = $this->renderPartial('..\variacion-gastos\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                     'dataProvider' => $dataProvider,
                                                                ]);
                    return $content1;
                   {
          
       
                  break;
                   }
     case 9 :  
                    $searchModel = new \frontend\models\CapitalSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $periodo = \frontend\models\Capital::findOne(['anexoid'=>$evaluacionanexo->id])->fecha;
                    $periodo = \Yii::$app->formatter->asDate($periodo,'M-Y');
        
                    $content =  $this->renderPartial('..\capital\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider,
                                                    'periodo' => $periodo,
                                                ]);
                    return $content;
         
                   {
                  
                  break;
                   }
     case 10 :      $searchModel = new \frontend\models\CiclosSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\ciclos\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                            ]);
         
         
                    return $content1;
                  {
                  
                  break;
                   }
     case 11 :          $searchModel = new \frontend\models\CuentasSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                        $dataProvider->pagination = FALSE;
                        $tipocuenta = \frontend\models\Cuentas::findOne(['anexoid'=>$evaluacionanexo->id]);

                        $content1 =  $this->renderPartial('..\cuentas\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'tipocuenta'=>$tipocuenta,
                                                        ]);
                        return $content1;     {
                  
                  break;
                   }
     case 12 :       $searchModel = new \frontend\models\CuentasSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                        $tipocuenta = \frontend\models\Cuentas::findOne(['anexoid'=>$evaluacionanexo->id]);

                        $content1 =  $this->renderPartial('..\cuentas\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'tipocuenta'=>$tipocuenta,
                                                        ]);
                        return $content1; 
                   {
                  
                  break;
                   }
     case 13 :      $searchModel = new \frontend\models\PerdidaInvestigacionSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $expediente = \frontend\models\PerdidaInvestigacion::findOne(['anexoid'=>$evaluacionanexo->id]);
                    $content1 = $this->renderPartial('..\perdida-investigacion\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'expediente'=>$expediente,
        ]);
         
         
         return $content1; 
         
                   {
                  
                  break;
                   }
     case  14 :  $searchModel = new \frontend\models\PerdidaInvestigacionSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $expediente = \frontend\models\PerdidaInvestigacion::findOne(['anexoid'=>$evaluacionanexo->id]);
                    $content1 = $this->renderPartial('..\perdida-investigacion\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'expediente'=>$expediente,
                                                            ]);
         
         
         return $content1;  
                   {
                  
                  break;
                   }
     case 15 :  $searchModel = new \frontend\models\PerdidaInvestigacionSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $expediente = \frontend\models\PerdidaInvestigacion::findOne(['anexoid'=>$evaluacionanexo->id]);
                    $content1 = $this->renderPartial('..\perdida-investigacion\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'expediente'=>$expediente,
        ]);
         
         
         return $content1; 
                   {
                  
                  break;
                   }
     case 16 :      $searchModel1 = new \frontend\models\VentasSearch();
                    $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                    $dataProvider1->query->andFilterWhere(['anexoid'=> $evaluacionanexo->id]);
                    $dataProvider1->pagination = FALSE;
                    
                    $venta = \frontend\models\Ventas::findOne(['anexoid'=>$evaluacionanexo->id]);
                 
                    $content1=$this->renderPartial('..\ventas\indexpdf', [
                                                    'searchModel' => $searchModel1,
                                                    'dataProvider' => $dataProvider1,
                                                    'venta' =>$venta,    
                                                   ]);         
         
                    
                                                   return $content1;
                     {
                  
                  break;
                   }
     case 17 :         $searchModel = new \frontend\models\ImpuestoSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                         $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                         $content1= $this->renderPartial('..\impuesto\indexpdf', [
                                                            'searchModel' => $searchModel,
                                                            'dataProvider' => $dataProvider,
                                                            ]);
         
         
         
         return $content1;
                
                   {
                  
                  break;
                   }
     case 18 : 
                    $searchModel = new \frontend\models\UtilidadSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 =  $this->renderPartial('..\utilidad\indexpdf', [
                                                'searchModel' => $searchModel,
                                                'dataProvider' => $dataProvider,
        ]);
         
         
         return $content1 ;
                
                   {
                  
                  break;
                   }
     case 19 :
         
                 $searchModel = new \frontend\models\ValorAgregadoSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                $content1 =  $this->renderPartial('..\valor-agrgado\indexpdf', [
                                                'searchModel' => $searchModel,
                                                'dataProvider' => $dataProvider,
                                                ]);
         return $content1;
                   {
                  
                  break;
                   }
     case 20 :
         
                    $searchModel = new \frontend\models\ProductividadSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\productividad\indexpdf', [
                                                'searchModel' => $searchModel,
                                                'dataProvider' => $dataProvider,
                                                           ]);
         return $content1;
                   {
                  
                  break;
                   }
     case 21 : // return ($evaluacionanexo); 
                    $searchModel = new \frontend\models\FondoSalarioSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\fondo-salario\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider,
                                                    ]);
         
         
         
         
                    return $content1;
               
                   {
                  
                  break;
                   }
     case 22 :      $searchModel = new \frontend\models\UtilidadxpesoSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\utilidadxpeso\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider,
                                                               ]);
         
         
         
         
         
         return $content1;
               
                   {
                  
                  break;
                   }
     case 23 : 
                $searchModel = new \frontend\models\ComedorSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\comedor\indexpdf', [
                                 'searchModel' => $searchModel,
                                 'dataProvider' => $dataProvider,
                    ]);
         
         
         return $content1;   
                    {
                  
                  break;
                   }
     case 24 : 
                   {
                                      
                  break;
                   }
     case 25 :      
         
                    $searchModel1 = new \frontend\models\FondoTiempoSearch();
                    $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                    $dataProvider1->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider1->pagination = FALSE;
                 
                    $content1=$this->renderPartial('..\fondo-tiempo\indexpdf', [
                                                    'searchModel' => $searchModel1,
                                                    'dataProvider' => $dataProvider1,
                                                   ]);         
         
                    
                                                   return $content1;
                                 
                   {
                  
                  break;
                   }
     
     }               
                    
     
   }
   
    
   public static function Porciento($a,$b) 
   {
       return ($b/$a)*100;
       
   }
   
    }
    
    

