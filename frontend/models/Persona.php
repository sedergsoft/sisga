<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property string $CI
 * @property string $Nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $sexo
 *
 * @property Cuadro[] $cuadros
 * @property Familiar[] $familiars
 * @property RelacionesExterior[] $relacionesExteriors
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CI', 'Nombre', 'primer_apellido', 'segundo_apellido', 'sexo'], 'required'],
            [['CI'], 'string', 'max' => 11],
             [['CI'], 'ValidarCI','message' => 'El Número de identidad no es valido.Por favor verifique su número.'],
           [['Nombre', 'primer_apellido', 'segundo_apellido'], 'string', 'max' => 255],
            [['sexo'], 'string', 'max' => 1],
            [['CI'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CI' => Yii::t('app', 'Ci'),
            'Nombre' => Yii::t('app', 'Nombre'),
            'primer_apellido' => Yii::t('app', 'Primer Apellido'),
            'segundo_apellido' => Yii::t('app', 'Segundo Apellido'),
            'sexo' => Yii::t('app', 'Sexo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['personaCI' => 'CI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliars()
    {
        return $this->hasMany(Familiar::className(), ['personaCI' => 'CI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacionesExteriors()
    {
        return $this->hasMany(RelacionesExterior::className(), ['personaCI' => 'CI']);
    }
     public function ValidarCI() 
    {
        $valido = FALSE;
        $ci = $this->CI;
      // $t = strlen(ci);        
     if(strlen($ci) == 11 )
     { 
       $mes = substr($ci,2,2);
       $dia = substr($ci,4,2);
       if($mes == 02)
       {
           if($dia < 29 && $dia > 00)
           {
             $valido = TRUE;  
           }
       }
       else{
           if($mes >00 && $mes < 13)
            {
               if($dia < 31 && $dia > 00)
                   $valido = TRUE;
            }
       }
                 
     }
    
     return $valido;
   }

}
