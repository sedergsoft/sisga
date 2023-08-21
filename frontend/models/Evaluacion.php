<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "evaluacion".
 *
 * @property int $id
 * @property double $valor_vreal
  * @property string $fecha_informacion
 * @property string $fechacreado
 * @property int $direccionid
 * @property int $criteriomedidaid
 * @property int $estado
 * @property int $periodo
 * @property int $userid
 * @property string $observaciones
 * @property int $status
 * @property int $anexo
 * @property int $actual
 *
 * @property EstadoCumplimiento $estado0
 * @property Direccion $direccion
 * @property User $user
 * @property Criteriomedida $criteriomedida
 * @property Periodo $periodo0
 * @property EvaluacionAnexo[] $evaluacionAnexos
 */
class Evaluacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor_vreal'], 'required'],
            [['valor_vreal'], 'number'],
            [[ 'fecha_informacion'], 'safe'],
            [['anexo'], 'integer'],
            [['observaciones',], 'string'],
           [['fechacreado'],'ValidarFecha'],
            //[['estado'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoCumplimiento::className(), 'targetAttribute' => ['estado' => 'id']],
            //[['direccionid'], 'exist', 'skipOnError' => true, 'targetClass' => Direccion::className(), 'targetAttribute' => ['direccionid' => 'id']],
            //[['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
            //[['criteriomedidaid'], 'exist', 'skipOnError' => true, 'targetClass' => Criteriomedida::className(), 'targetAttribute' => ['criteriomedidaid' => 'id']],
            //[['periodo'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::className(), 'targetAttribute' => ['periodo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'valor_vreal' => Yii::t('app', 'Valor'),

            'direccionid' => Yii::t('app', 'Direccionid'),
            'criteriomedidaid' => Yii::t('app', 'Criteriomedidaid'),
            'estado' => Yii::t('app', 'Estado'),
            'periodo' => Yii::t('app', 'Periodo'),
            'userid' => Yii::t('app', 'Userid'),
            'observaciones' => Yii::t('app', 'Observaciones'),
            'status' => Yii::t('app', 'Status'),
            'anexo' => Yii::t('app', 'Anexo'),
            'fechacreado' => Yii::t('app', 'Fecha de cierre de la Información'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(EstadoCumplimiento::className(), ['id' => 'estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireccion()
    {
        return $this->hasOne(Direccion::className(), ['id' => 'direccionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCriteriomedida()
    {
        return $this->hasOne(Criteriomedida::className(), ['id' => 'criteriomedidaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodo0()
    {
        return $this->hasOne(Periodo::className(), ['id' => 'periodo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionAnexos()
    {
        return $this->hasMany(EvaluacionAnexo::className(), ['evaluacionid' => 'id']);
    }
   /*  public function ValidarFecha() 
    {
       $valido = FALSE;
        date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
       /*date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
            $model->fecha_informacion = date('Y-m-d');*/
     //  $fechacreado = $this->fechacreado;
      /* if(date('d')> 15)
       {
           if(date('m') == date_format($fechacreado, 'm'))
           {
               $valido = TRUE;
           }else{
                if(date('m') == date_format($fechacreado, 'm')+1)
                {
                 $valido = FALSE ;  
                }
           
           }
       }
       
       return $valido;
    }*/
public function ValidarFecha($attributes, $params)
    {
      date_default_timezone_set('America/Bogota');
     if(!empty($this->attributes['fechacreado']))
         {
    $fecha = $this->attributes['fechacreado'] ;
    $dia = substr($fecha, 8,2);
    $mes = substr($fecha,5, 2);
    $anno = substr($fecha, 0, 4);
    if((date('d')> 30 && date('m') >= $mes +1) )
    {
     $this->addError($attributes, "La fecha es incorrecta, desde el dia 15 solo puede agregar información correspondiente a este mes");
    }
    else{
        if( date('Y') != $anno)
            {
            $this->addError($attributes, "La fecha es incorrecta, solo puede agregar información correspondiente a este año");
           }
        }
    if( date('m') < $mes  )
    {
     $this->addError($attributes, "La fecha es incorrecta, no puede agregar información de meses adelendatos");
    
    }
  if((date('d')< 30 && date('m') > $mes +1) )
    {
     $this->addError($attributes, "La fecha es incorrecta, solo puede agregar información de este mes o del mes anterior");
    } 
     if((date('d')<$dia && date('m') == $mes && date('Y')==$anno ) )
    {
     $this->addError($attributes, "La fecha es incorrecta, el dia de que ha selecionado aún no ha llegado");
    }    
     }
    }
}
