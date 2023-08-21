<?php

namespace frontend\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "cumplimiento".
 *
 * @property int $indicadores_gestionid
 * @property int $userid
 * @property int $id
 * @property double $valor
 * @property string $observaciones
 * @property int $estado_cumplimientoid
 * @property string $fecha
  * @property string $fecha_informacion
 *  @property int $anexo
 * @property int $status
 * @property int $actual
 *
 * @property IndicadoresGestion $indicadoresGestion
 * @property EstadoCumplimiento $estadoCumplimiento
 * @property User $user
 */
class Cumplimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cumplimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor'], 'required'],
            [['indicadores_gestionid', 'userid', 'estado_cumplimientoid','anexo' ], 'integer'],
            [['valor'], 'number'],
            [['observaciones'], 'string'],
            [['fecha','fecha_informacion'], 'safe'],
            [['fecha'], 'ValidarFecha'],          
//  [['indicadores_gestionid'], 'exist', 'skipOnError' => true, 'targetClass' => IndicadoresGestion::className(), 'targetAttribute' => ['indicadores_gestionid' => 'id']],
          //  [['estado_cumplimientoid'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoCumplimiento::className(), 'targetAttribute' => ['estado_cumplimientoid' => 'id']],
           // [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'indicadores_gestionid' => Yii::t('app', 'Indicadores Gestionid'),
            'userid' => Yii::t('app', 'Userid'),
            'id' => Yii::t('app', 'ID'),
            'valor' => Yii::t('app', 'Valor'),
            'observaciones' => Yii::t('app', 'Observaciones'),
            'estado_cumplimientoid' => Yii::t('app', 'Estado Cumplimientoid'),
            'fecha' => Yii::t('app', 'Fecha de cierre de la Información'),
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicadoresGestion()
    {
        return $this->hasOne(IndicadoresGestion::className(), ['id' => 'indicadores_gestionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoCumplimiento()
    {
        return $this->hasOne(EstadoCumplimiento::className(), ['id' => 'estado_cumplimientoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
    public function ValidarFecha($attributes, $params)
    {
      date_default_timezone_set('America/Bogota');
     if(!empty($this->attributes['fecha']))
         {
    $fecha = $this->attributes['fecha'] ;
    $dia = substr($fecha, 8,2); //contiene el dia de la fecha entrada por el usaurio(fecha de cierre de la información)
    $mes = substr($fecha,5, 2);//contiene el mes de la fecha entrada por el usaurio(fecha de cierre de la información)
    $anno = substr($fecha, 0, 4);//contiene el año de la fecha entrada por el usaurio(fecha de cierre de la información)
    if((date('d')> 30 && date('m') >= $mes +1) )
    {
     $this->addError($attributes, "La fecha es incorrecta, desde el dia 15 solo puede agregar información correspondiente a este mes");
    }
    else{
        if( date('Y') != $anno)
            {
                if((date('Y') != $anno + 1) && ($mes != '12'))
                {
                    $this->addError($attributes, "La fecha es incorrecta, solo puede agregar información correspondiente a este año");
                }else{
                      if(date('Y') != $anno && date ('m')==$mes)
                      {
                    $this->addError($attributes, "La fecha es incorrecta, solo puede agregar información correspondiente a este año o al mes de diciembre de año anterior");
                          
                      }
                    
                     }
            
            }
        }
    if( date('m') < $mes  && date('Y') == $anno)
    {
     $this->addError($attributes, "La fecha es incorrecta, no puede agregar información de meses adelendatos");
    
    }
  if((date('d')< 30 && date('m') > $mes +1 && date('Y') == $anno) )
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
