<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
//use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\popover\PopoverX;


$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
// \macgyer\yii2materializecss\assets\MaterializeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="'.$baseUrl.'/uploads/images/Logo_GA(sombra-pequeno)3.png" style="display:inline; horizontal-align: top; height:35px;">'.Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top nav-sisga',
        ],
    ]);
    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
       //   ['label' => 'name', 'url' => ['/site/name']],
       // ['label' => 'About', 'url' => ['/site/about']],
         ];
   
   
    if (Yii::$app->user->isGuest) {
        
       
       /*  $menuItems[] = ['label' => 'Ver Cumplimiento',
                            'items' =>[
                                ['label' => 'Evaluación del Objetivo', 'url' => ['/objetivo/evaluar']],
                                  ['label' => 'Criterio Medida', 'url' => ['/evaluacion/indexall']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/cumplimiento/indexall']],
                                 
                                 //['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];*/
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];        
    } else {
             if(Yii::$app->user->identity->rolid == "1")//menu que se muestra para el usuario SiteAdmin
             {
         /*   $menuItems[] = ['label' => 'Llenar indicadores ',
                            'items' =>[
                                  
                                ['label' => 'Direccion de Capital humano', 'url' => ['/indicadoresgestion/llenar','id'=>6]],  
                                ['label' => 'Dirección Jurídica', 'url' => ['/indicadoresgestion/llenar','id'=>3]], 
                                ['label' => 'Dirección de Economía, Contabilidad y Finanzas', 'url' => ['/indicadoresgestion/llenar','id'=>8]], 
                                ['label' => 'Dirección Supervisión y Control Interno', 'url' => ['/indicadoresgestion/llenar','id'=>13]], 
                                ]];
         */
           /* $menuItems[] = ['label' => 'Ver',
                            'items' =>[
                                ['label' => 'Ver direciones', 'url' => ['/direccion/index']],
                                ['label' => 'Ver objetivo', 'url' => ['/objetivo/index']],
                                ['label' => 'Ver Criterio Medida', 'url' => ['/criteriomedida/index']],
                                ['label' => 'Ver Indicadores de Gestión', 'url' => ['/indicadoresgestion/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
      
         
                /*$menuItems[] = ['label' => 'Gestionar',
                            'items' =>[
                                  ['label' => 'Asignar parametros', 'url' => ['/criteriodireccion/index']],
                                ['label' => 'Cumplimiento', 'url' => ['/cumplimiento/index']],
                                 ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];*/
               $menuItems[] = ['label' => 'Permisos',
                            'items' =>[
                                  ['label' => ' Permisos', 'url' => ['/rbac/permission/']],
                                  ['label' => ' Roles', 'url' => ['/rbac/role/']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
                 $menuItems[] = ['label' => 'Seguridad',
                    'items' =>[            
                           // ['label' => 'ver usuarios', 'url' => ['/user/index']],
                            ['label' => 'Trazas', 'url' => ['/trazas/index']],
                            ['label' => 'Base de Datos', 'url' => ['/backuprestore/index']],
                           
                          ]]; 
        
             }
             if(Yii::$app->user->identity->rolid == "2")//menu que se muestra para el usuario Admin
             {
           /* $menuItems[] = ['label' => 'Llenar indicadores ',
                            'items' =>[
                                  
                                ['label' => 'Direccion de Capital humano', 'url' => ['/indicadoresgestion/llenar','id'=>6]],  
                                ['label' => 'Dirección Jurídica', 'url' => ['/indicadoresgestion/llenar','id'=>3]], 
                                ['label' => 'Dirección de Economía, Contabilidad y Finanzas', 'url' => ['/indicadoresgestion/llenar','id'=>8]], 
                                ['label' => 'Dirección Supervisión y Control Interno', 'url' => ['/indicadoresgestion/llenar','id'=>13]], 
                                ]];*/
         
            $menuItems[] = ['label' => 'Mostrar',
                            'items' =>[
                                ['label' => 'Direciones', 'url' => ['/direccion/index']],
                                ['label' => 'Objetivo', 'url' => ['/objetivo/index']],
                                ['label' => 'Criterio Medida', 'url' => ['/criteriomedida/index']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/indicadoresgestion/index']],
                                ['label' => 'Plantillas', 'url' => ['/plantilla/index']],
                                  ]];
      
         
                $menuItems[] = ['label' => 'Ver Cumplimiento',
                            'items' =>[
                                ['label' => 'Evaluación del Objetivo', 'url' => ['/objetivo/evaluar']],
                                  ['label' => 'Criterio Medida', 'url' => ['/evaluacion/indexall']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/cumplimiento/indexall']],
                                 
                                 //['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
                $menuItems[] = ['label' => 'Analisis',
                            'items' =>[
                                  //['label' => 'Generar Informe', 'url' => ['/site/generar']],
                                  ['label' => 'Generar Informe ', 'url' => ['/informe/index']],
                                  ['label' => 'Ver Ventas Netas', 'url' => ['/ventas/indexview','id'=>2]],
                                  ['label' => 'Ver Ventas Liberadas', 'url' => ['/ventas/indexview','id'=>3]],
                                  ['label' => 'Ver empresa', 'url' => ['/empresa/verinfoempresa']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                                  ]];
                 $menuItems[] = ['label' => 'Nomencladores',
                            'items' =>[
                                ['label' => 'Empresas', 'url' => ['/empresa/index']],
                                ['label' => 'Productos', 'url' => ['/producto/index']],
                               /* ['label' => 'Criterio Medida', 'url' => ['/criteriomedida/index']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/indicadoresgestion/index']],*/
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
                $menuItems[] = ['label' => 'Seguridad',
                            'items' =>[
                                  ['label' => 'Usuarios', 'url' => ['/user/index']],
                                 ['label' => 'Asignar Permisos', 'url' => ['/rbac/assignment']],
                                  ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                                 ['label'=> 'Definir Preguntas de Control' , 'url' => ['/control-usuario/create']],
                                
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                               ]]; 
     
                 
             
                                 
             }
              if(Yii::$app->user->identity->rolid == "3")//menu que se muestra para el usuario Director
             {
                  
             /* $menuItems[] = ['label' => 'Ver Objetivo', 'url' => ['/objetivo/index'],
                                  ];  */
                  
           $menuItems[] = ['label' => 'Llenar Información',
                            'items' =>[
                                  
                                ['label' => 'Indicadores', 'url' => ['/indicadoresgestion/llenar']],  
                                ['label' => 'Criterios de Medida', 'url' => ['/criteriomedida/llenar']], 
                               ]];
           
          $menuItems[] = ['label' => 'Certificar Información',
                            'items' =>[
                                  
                                ['label' => 'Indicadores', 'url' => ['/cumplimiento/index']],  
                                ['label' => 'Criterios de Medida', 'url' => ['/evaluacion/index']], 
                               ]];
           
            
               $menuItems[] = ['label' => 'Ver',
                            'items' =>[
                                ['label' => 'Direciones', 'url' => ['/direccion/index']],
                                ['label' => 'Objetivo', 'url' => ['/objetivo/index']],
                                ['label' => 'Criterio Medida', 'url' => ['/criteriomedida/index']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/indicadoresgestion/index']],
                                '<li class="divider"></li>',
                                ['label' => 'Cumplimiento de Indicadores', 'url' => ['/cumplimiento/indexcumplimiento']],
                                ['label' => 'Cumplimiento de Criterios', 'url' => ['/evaluacion/indexcumplimiento']],
                                  ]];
              /*   $menuItems[] = ['label' => 'Analisis',
                            'items' =>[
                                  ['label' => 'Generar Informe', 'url' => ['/site/generar']],
                                //  ['label' => 'Ver Ventas', 'url' => ['/ventas/indexview']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                                  ]];
               */
       $menuItems[] = ['label' => 'Seguridad',
                            'items' =>[
                                
                                  ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                                ['label'=> 'Definir Preguntas de Control' , 'url' => ['/control-usuario/create']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                               ]]; 
     
                               $options = ['class'=>"glyphicon glyphicon-bell",
                            'style'=>"left: 9px;color: #cac7c7;;animation: vertical;animation-duration: 2s;animation-timing-function: ease;animation-delay: 2s;animation-iteration-count: 5;"
                    ];
     
                
                  if(frontend\controllers\SiteController::haynotificaciones())
                  {
                  $menuItems[] = '<li>'.PopoverX::widget([
                'header' => frontend\controllers\SiteController::notificaciones().' Notificacion(es) sin Atender',
                'headerOptions'=>['align'=>'center'],
                'placement' => PopoverX::ALIGN_BOTTOM_LEFT,
                'size' => 'sm',
                'type' => PopoverX::TYPE_DANGER,
                'content' => \frontend\controllers\SiteController::formarnotificaciones(),
               'toggleLink'=>true, 
               'toggleButton' => ['label' => ''. Html::tag('i', '',$options).'<span class="badge badge-warning navbar-badge" style="background-color:#f12525;margin-bottom: 17px;font-size:10px">'.frontend\controllers\SiteController::notificaciones().'</span></a>',
                                    'class'=>'navbar-inverse nav-sisga'
                ],
                'pluginOptions' => [
                   'dialogCss' => ['top' => '80px'], // will overlay the popover over the navbar
                ]
            ])
                          
            . '</li>';   
               
                  }
                  else{
                      $menuItems[] = '<li>'.PopoverX::widget([
                'header' => frontend\controllers\SiteController::notificaciones().' Notificacion(es) sin Atender',
                'headerOptions'=>['align'=>'center'],
                'placement' => PopoverX::ALIGN_BOTTOM_RIGHT,
                'size' => 'sm',
                'type' => PopoverX::TYPE_INFO,
                'content' => \frontend\controllers\SiteController::formarnotificaciones(),
               'toggleLink'=>true, 
               'toggleButton' => ['label' => ''. Html::tag('i', '',$options).'<span class="badge badge-warning navbar-badge" style="background-color:#34495e;color:#34495e;margin-bottom: 17px;font-size:10px">'.frontend\controllers\SiteController::notificaciones().'</span></a>',
                                    'class'=>'navbar-inverse nav-sisga'
                ],
               'pluginOptions' => [
                   'dialogCss' => ['top' => '80px'], // will overlay the popover over the navbar
                ]
            ])
                          
            . '</li>';   
               
                      
                  }
                  }
                    if(Yii::$app->user->identity->rolid == "4")//menu que se muestra para el usuario Especialista
             {
           $menuItems[] = ['label' => 'Llenar Información',
                            'items' =>[
                                  
                                ['label' => 'Indicadores', 'url' => ['/indicadoresgestion/llenar']],  
                                ['label' => 'Criterios de Medida', 'url' => ['/criteriomedida/llenar']], 
                               ]];
         
            
             /*  $menuItems[] = ['label' => 'Ver',
                            'items' =>[
                                ['label' => 'Ver direciones', 'url' => ['/direccion/index']],
                                ['label' => 'Ver objetivo', 'url' => ['/objetivo/index']],
                                ['label' => 'Ver Criterio Medida', 'url' => ['/criteriomedida/index']],
                                ['label' => 'Ver Indicadores de Gestión', 'url' => ['/indicadoresgestion/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
      
         
             /*   $menuItems[] = ['label' => 'Gestionar',
                            'items' =>[
                                  ['label' => 'Asignar parametros', 'url' => ['/criteriodireccion/index']],
                                ['label' => 'Cumplimiento', 'url' => ['/cumplimiento/index']],
                                 ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
                $menuItems[] = ['label' => 'Documentos',
                            'items' =>[
                                  ['label' => 'Generar Libro', 'url' => ['/site/generar']],
                                ['label' => 'Cumplimiento', 'url' => ['/cumplimiento/index']],
                                 ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];*/
       $menuItems[] = ['label' => 'Seguridad',
                            'items' =>[
                                
                                  ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                                ['label'=> 'Definir Preguntas de Control' , 'url' => ['/control-usuario/create']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                               ]]; 
     
               
             }
                if(Yii::$app->user->identity->rolid == "5")//menu que se muestra para el usuario presidente
             {
           /* $menuItems[] = ['label' => 'Llenar indicadores ',
                            'items' =>[
                                  
                                ['label' => 'Direccion de Capital humano', 'url' => ['/indicadoresgestion/llenar','id'=>6]],  
                                ['label' => 'Dirección Jurídica', 'url' => ['/indicadoresgestion/llenar','id'=>3]], 
                                ['label' => 'Dirección de Economía, Contabilidad y Finanzas', 'url' => ['/indicadoresgestion/llenar','id'=>8]], 
                                ['label' => 'Dirección Supervisión y Control Interno', 'url' => ['/indicadoresgestion/llenar','id'=>13]], 
                                ]];*/
         
            $menuItems[] = ['label' => 'Mostrar',
                            'items' =>[
                                ['label' => 'Direciones', 'url' => ['/direccion/index']],
                                ['label' => 'Objetivo', 'url' => ['/objetivo/index']],
                                ['label' => 'Criterio Medida', 'url' => ['/criteriomedida/index']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/indicadoresgestion/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
      
         
                $menuItems[] = ['label' => 'Ver Cumplimiento',
                            'items' =>[
                                ['label' => 'Evaluación del Objetivo', 'url' => ['/objetivo/evaluar']],
                                  ['label' => 'Criterio Medida', 'url' => ['/evaluacion/indexall']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/cumplimiento/indexall']],
                                 
                                 //['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
                 $menuItems[] = ['label' => 'Analisis',
                            'items' =>[
                                ['label' => 'Generar Informe', 'url' =>['/informe/index']]                                  
                                //['label' => 'Generar Informe', 'url' => ['/site/generar']],
                                //  ['label' => 'Ver Ventas', 'url' => ['/ventas/indexview']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                                  ]];
               
                
                 $menuItems[] = ['label' => 'Seguridad',
                            'items' =>[
                                
                                  ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                                ['label'=> 'Definir Preguntas de Control' , 'url' => ['/control-usuario/create']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                               ]]; 
     
             }
            if(Yii::$app->user->identity->rolid == "6")//menu que se muestra para el usuario Gestor de Cuadros
             {
           /* $menuItems[] = ['label' => 'Llenar indicadores ',
                            'items' =>[
                                  
                                ['label' => 'Direccion de Capital humano', 'url' => ['/indicadoresgestion/llenar','id'=>6]],  
                                ['label' => 'Dirección Jurídica', 'url' => ['/indicadoresgestion/llenar','id'=>3]], 
                                ['label' => 'Dirección de Economía, Contabilidad y Finanzas', 'url' => ['/indicadoresgestion/llenar','id'=>8]], 
                                ['label' => 'Dirección Supervisión y Control Interno', 'url' => ['/indicadoresgestion/llenar','id'=>13]], 
                                ]];
         
            $menuItems[] = ['label' => 'Mostrar',
                            'items' =>[
                                ['label' => 'Direciones', 'url' => ['/direccion/index']],
                                ['label' => 'Objetivo', 'url' => ['/objetivo/index']],
                                ['label' => 'Criterio Medida', 'url' => ['/criteriomedida/index']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/indicadoresgestion/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
      
         
                $menuItems[] = ['label' => 'Ver Cumplimiento',
                            'items' =>[
                                ['label' => 'Evaluación del Objetivo', 'url' => ['/objetivo/evaluar']],
                                  ['label' => 'Criterio Medida', 'url' => ['/evaluacion/indexall']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/cumplimiento/indexall']],
                                 
                                 //['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];*/
                 $menuItems[] = ['label' => 'Cuadros',
                            'items' =>[
                                ['label' => 'Agregar Cuadro', 'url' =>['/cuadro/createwiz']] ,                                 
                                ['label' => 'Ver Cuadros', 'url' => ['/cuadro/index']],
                                //['label' => 'Ver Cuadros', 'url' => ['/cuadro/index']],
                                ['label' => 'Plan de evaluación', 'url' => ['/plan-evaluacion/index']],
                                ['label' => 'Ver Evaluaciones', 'url' => ['/evaluacion-cuadro/index']],
                                ['label' => 'Ver Evaluaciones por cuadro', 'url' => ['/evaluacion-cuadro/verevaluacioncuadro']],
                                
                                  ]];
               
                 $menuItems[] = ['label' => 'Propuesta de Movimiento',
                            'items' =>[
                                ['label' => 'Pendientes','url' => ['/movimiento-cuadro/index']] ,                                 
                                ['label' => 'Aprobadas', 'url' => ['/movimiento-cuadro/aprobadas']],
                                ['label' => 'Rechazadas', 'url' => ['/movimiento-cuadro/rechazadas']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                                  ]];
               
                 $menuItems[] = ['label' => 'Informes',
                            'items' =>[
                                ['label' => 'Modelo estadístico del proceso de evaluacion','url' => ['/evaluacion-cuadro/estadistica']] ,                                 
                             //   ['label' => 'Aprobadas', 'url' => ['/movimiento-cuadro/aprobadas']],
                              //  ['label' => 'Rechazadas', 'url' => ['/movimiento-cuadro/rechazadas']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                                  ]];
               
                 $menuItems[] = ['label' => 'Nomencladores',
                            'items' =>[
                                ['label' => 'Cargos','url' => ['/cargos-direccion/index']] ,                                 
                                ['label' => 'Organismos', 'url' => ['/organismo/index']],
                                ['label' => 'Indicadores de Evaluación', 'url' => ['/indicadores-evaluacion/index']],
                                ['label' => 'Escuelas Politicas', 'url' => ['/escuela-politica/index']],
                                ['label' => 'Tipos de Ingresos', 'url' => ['/tipo-ingresos/index']],
                                
                                  ]];
               
                
                 $menuItems[] = ['label' => 'Seguridad',
                            'items' =>[
                                
                                  ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                                ['label'=> 'Definir Preguntas de Control' , 'url' => ['/control-usuario/create']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                               ]]; 
     
             }
               
            if(Yii::$app->user->identity->rolid == "7")//menu que se muestra para el usuario Evaluador
             {
           /* $menuItems[] = ['label' => 'Llenar indicadores ',
                            'items' =>[
                                  
                                ['label' => 'Direccion de Capital humano', 'url' => ['/indicadoresgestion/llenar','id'=>6]],  
                                ['label' => 'Dirección Jurídica', 'url' => ['/indicadoresgestion/llenar','id'=>3]], 
                                ['label' => 'Dirección de Economía, Contabilidad y Finanzas', 'url' => ['/indicadoresgestion/llenar','id'=>8]], 
                                ['label' => 'Dirección Supervisión y Control Interno', 'url' => ['/indicadoresgestion/llenar','id'=>13]], 
                                ]];
         
            $menuItems[] = ['label' => 'Mostrar',
                            'items' =>[
                                ['label' => 'Direciones', 'url' => ['/direccion/index']],
                                ['label' => 'Objetivo', 'url' => ['/objetivo/index']],
                                ['label' => 'Criterio Medida', 'url' => ['/criteriomedida/index']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/indicadoresgestion/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];
      
         
                $menuItems[] = ['label' => 'Ver Cumplimiento',
                            'items' =>[
                                ['label' => 'Evaluación del Objetivo', 'url' => ['/objetivo/evaluar']],
                                  ['label' => 'Criterio Medida', 'url' => ['/evaluacion/indexall']],
                                ['label' => 'Indicadores de Gestión', 'url' => ['/cumplimiento/indexall']],
                                 
                                 //['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                  ]];*/
                 $menuItems[] = ['label' => 'Cuadros',
                            'items' =>[
                               // ['label' => 'Agregar Cuadro', 'url' =>['/cuadro/create']] ,                                 
                               // ['label' => 'Ver Cuadros', 'url' => ['/cuadro/index']],
                                ['label' => 'Evaluar Cuadro', 'url' => ['/plan-evaluacion/indexuser']],
                                ['label' => 'Ver Evaluaciones', 'url' => ['/evaluacion-cuadro/index']],
                                ['label' => 'Ver Evaluaciones por cuadro', 'url' => ['/evaluacion-cuadro/verevaluacioncuadro']],
                                
                                  ]];
               /*
                 $menuItems[] = ['label' => 'Propuesta de Movimiento',
                            'items' =>[
                                ['label' => 'Pendientes','url' => ['/movimiento-cuadro/index']] ,                                 
                                ['label' => 'Aprobadas', 'url' => ['/movimiento-cuadro/aprobadas']],
                                ['label' => 'Rechazadas', 'url' => ['/movimiento-cuadro/rechazadas']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                                  ]];
               
                 $menuItems[] = ['label' => 'Informes',
                            'items' =>[
                                ['label' => 'Modelo estadístico del proceso de evaluacion','url' => ['/evaluacion-cuadro/estadistica']] ,                                 
                             //   ['label' => 'Aprobadas', 'url' => ['/movimiento-cuadro/aprobadas']],
                              //  ['label' => 'Rechazadas', 'url' => ['/movimiento-cuadro/rechazadas']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                                  ]];
               
                 $menuItems[] = ['label' => 'Nomencladores',
                            'items' =>[
                                ['label' => 'Cargos','url' => ['/cargos-direccion/index']] ,                                 
                                ['label' => 'Organismos', 'url' => ['/organismo/index']],
                                ['label' => 'Indicadores de Evaluación', 'url' => ['/indicadores-evaluacion/index']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                                  ]];
               */
                
                 $menuItems[] = ['label' => 'Seguridad',
                            'items' =>[
                                
                                  ['label'=> 'Cambiar contraseña' , 'url' => ['/user/password','id'=> Yii::$app->user->getId()]],
                                ['label'=> 'Definir Preguntas de Control' , 'url' => ['/control-usuario/create']],
                                // ['label' => 'Compromiso', 'url' => ['/compromiso/index']],
                                 // ['label' => 'Agregar Plato', 'url' => ['/plato/create']],
                                
                               ]]; 
                                 $options = ['class'=>"glyphicon glyphicon-bell",
                            'style'=>"left: 9px;color: #cac7c7;;animation: vertical;animation-duration: 2s;animation-timing-function: ease;animation-delay: 2s;animation-iteration-count: 5;"
                    ];
     
                
                  if(frontend\controllers\SiteController::haynotificaciones())
                  {
                  $menuItems[] = '<li>'.PopoverX::widget([
                'header' => frontend\controllers\SiteController::notificacionescuadros().' Notificacion(es) sin Atender',
                'headerOptions'=>['align'=>'center'],
                'placement' => PopoverX::ALIGN_BOTTOM_LEFT,
                'size' => 'sm',
                'type' => PopoverX::TYPE_DANGER,
                'content' => \frontend\controllers\SiteController::formarnotificacionescuadro(),
               'toggleLink'=>true, 
               'toggleButton' => ['label' => ''. Html::tag('i', '',$options).'<span class="badge badge-warning navbar-badge" style="background-color:#f12525;margin-bottom: 17px;font-size:10px">'.frontend\controllers\SiteController::notificacionescuadros().'</span></a>',
                                    'class'=>'navbar-inverse nav-sisga'
                ],
                'pluginOptions' => [
                   'dialogCss' => ['top' => '80px'], // will overlay the popover over the navbar
                ]
            ])
                          
            . '</li>';   
               
                  }
                  else{
                      $menuItems[] = '<li>'.PopoverX::widget([
                'header' => frontend\controllers\SiteController::notificacionescuadros().' Notificacion(es) sin Atender',
                'headerOptions'=>['align'=>'center'],
                'placement' => PopoverX::ALIGN_BOTTOM_RIGHT,
                'size' => 'sm',
                'type' => PopoverX::TYPE_INFO,
                'content' => \frontend\controllers\SiteController::formarnotificacionescuadro(),
               'toggleLink'=>true, 
               'toggleButton' => ['label' => ''. Html::tag('i', '',$options).'<span class="badge badge-warning navbar-badge" style="background-color:#34495e;color:#34495e;margin-bottom: 17px;font-size:10px">'.frontend\controllers\SiteController::notificaciones().'</span></a>',
                                    'class'=>'navbar-inverse nav-sisga'
                ],
               'pluginOptions' => [
                   'dialogCss' => ['top' => '80px'], // will overlay the popover over the navbar
                ]
            ])
                          
            . '</li>';   
               
                      
                  }
     
             }
               
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout',
                  'title'=> strtolower(Yii::$app->user->identity->username).' : ' .strtoupper( frontend\controllers\UserController::findModel(Yii::$app->user->getId())->rol->rol).' - '.strtoupper( frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->nombre),
                    ]
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    
    
    
<section id="title" class="emerald">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1> <?php echo ($this->params['tittle']) ? (yii\helpers\ArrayHelper::getValue($this->params['tittle'],0)):[];?></h1>
        <!-- <h5><?php //echo ($this->params['desc']) ? (yii\helpers\ArrayHelper::getValue($this->params['desc'],0)):[];?></h5>-->
        </div>
        <div class="col-sm-6 ">
            <div class="pull-right">   
           <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
                </div>
        </div>
      </div>
    </div>
  </section>
    
    
    
    
    <div class="container">
       
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>



<section id="bottom" class="wet-asphalt">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Misión</h4>
                    <p>
                    Coordinar y desarrollar el sistema de comercio mayorista que gestiona los inventarios de productos alimenticios y otros bienes de consumo, a importadores, productores nacionales, comerciantes minoristas y organismos priorizados, estimulando la satisfacción alimentaria de la población.</p>
                    
                </div><!--/.col-md-3-->

                <div class=" col-sm-4">
                    <h4>Visión</h4>
                    <p>
                        En el año 2021, somos el operador líder en el comercio mayorista de productos alimenticios para el mercado cubano, abastecemos oportunamente a nuestros clientes a través de sistema logístico moderno, calidad certificada y un capital humano competente e íntegro, que genera crecimiento y diversificación en la circulación de alimentos y otros bienes de consumo en el país.
                    </p>
                </div><!--/.col-md-3-->

               

                <div class=" col-sm-4">
                    <h4>Dirección</h4>
                    <address>
                        <strong>Domicilio Legal.</strong><br>
                        Avenida Camilo Cienfuegos No.1501<br>
                        entre carretera del Lucero y Línea Ferrocarril.<br>
                        Municipio: Arroyo Naranjo, <br>
                        Provincia: La Habana, Cuba. <br>
                        Email Corporativo : social@unal.cu <br>
                        <abbr title="Teléfonos">Telef:</abbr> (+53) 76941981 / (+53)76942294
                    </address>
                                    </div> <!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
              <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y').' v 0.09 (beta)' ?> </p> 
                </div>
                <div class="col-sm-4">
                    <?= Yii::powered().' Por SedergSoft, Inc.' ?> &copy;
                </div>
                <div class="col-sm-4">
                 <p class="pull-right">
                     <?php if(!Yii::$app->user->isGuest)
                         {?>
                 <span class = "glyphicon glyphicon-user" style="right: 365px"> 
                 
                     <p>  
                     <?php
                     echo strtolower(Yii::$app->user->identity->username).' : ' .strtoupper( frontend\controllers\UserController::findModel(Yii::$app->user->getId())->rol->rol).' - '.strtoupper( frontend\controllers\UserController::findModel(Yii::$app->user->getId())->direccion->nombre);
                      
                     }?>
                    </p>
                     
                 </span>      
                 </p>
                
                </div>

            </div>
        </div>
    </footer><!--/#footer-->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
