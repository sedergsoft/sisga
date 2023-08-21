<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "plantilla".
 *
 * @property int $id
 * @property int $cant_trabajadores
 * @property int $cant_cuadros
 * @property int $trabajadores_cubierta
 * @property int $cuadros_cubierta
 * @property int $empresaid
 */
class Plantilla extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plantilla';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cant_trabajadores', 'cant_cuadros', 'trabajadores_cubierta', 'cuadros_cubierta', 'empresaid'], 'integer'],
            ['trabajadores_cubierta','ValidarPlantillaTrabajadores'],
            ['cuadros_cubierta','ValidarPlantillaCuadro'],
            ['cant_cuadros','ValidarPlantillaTrabajadoresCuadros'],
            
            [['empresaid'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cant_trabajadores' => Yii::t('app', 'Cantidad de Trabajadores Aprobados'),
            'cant_cuadros' => Yii::t('app', 'Cantidad de Cuadros Aprobados'),
            'trabajadores_cubierta' => Yii::t('app', 'Cantidad de Trabajadores Cubiertos'),
            'cuadros_cubierta' => Yii::t('app', 'Cantidad de Cuadros Cubierto'),
            'empresaid' => Yii::t('app', 'Empresa'),
        ];
    }
    
      public function ValidarPlantillaCuadro() 
    {
   if($this->cuadros_cubierta > $this->cant_cuadros)
   {       
       
   $this->addError('cuadros_cubierta', 'La cantidad de Cuadros no puede ser mayor que la plantilla.');
   }
    }
      public function ValidarPlantillaTrabajadores() 
    {
   if($this->trabajadores_cubierta > $this->cant_trabajadores)
   {       $this->addError('trabajadores_cubierta', 'La cantidad de Trabajadores no puede ser mayor que la plantilla.');
  
   }
    }
     public function ValidarPlantillaTrabajadoresCuadros() 
    {
   if($this->cant_cuadros > $this->cant_trabajadores)
   {       $this->addError('cant_cuadros', 'La cantidad de Cuadros no puede ser mayor que la cantidad de trabajadores.');
          $this->addError('cant_trabajadores', 'La cantidad de Cuadros no puede ser mayor que la cantidad de trabajadores.');
  
   }
    }
}
