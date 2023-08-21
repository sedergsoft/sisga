<?php

namespace common\models;

use Yii;
use frontend\models\Trazas;
use yii\db\ActiveRecord;


class SaveTrazas extends ActiveRecord
{
    public function GuardaTraza($tabl,$acc,$new = NULL,$old = NULL)
    {
      $table = new Trazas(); 
      $table->IdUsuario = Yii::$app->user->getId();
      
      if(Yii::$app->request->userIP == "::1")
      { 
         $table->ip = "127.0.0.1";   
      }
      else
      {        
         $table->ip = Yii::$app->request->userIP;  
      }                    
      $table->tarea_realizada = $acc;
      $table->valor_antiguo = $old;
      $table->valor_actual = $new;
      $table->Tabla_Afectada = $tabl;
      $table->fecha =  date("Y-m-d");
      $table->hora =  date("H:i:s");
      
      //return print_r($table);
      $table->save();
    }    
}

