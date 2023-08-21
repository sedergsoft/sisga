<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "trazas".
 *
 * @property int $IdTraza
 * @property int $IdUsuario
 * @property string $ip
 * @property string $tarea_realizada
 * @property string $Tabla_Afectada
 * @property string $fecha
 * @property string $hora
 * @property string $id_modificado
 * @property string $valor_antiguo
 * @property string $valor_actual
 * @property string $ubicacion
 *
 * @property User $usuario
 */
class Trazas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trazas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['IdUsuario', 'ip', 'id_modificado'], 'required'],
            [['IdUsuario'], 'integer'],
            [['fecha', 'hora'], 'safe'],
            /*[['valor_antiguo', 'valor_actual'], 'string'],*/
       /*     [['ip'], 'string', 'max' => 28],
            [['tarea_realizada'], 'string', 'max' => 200],
            [['Tabla_Afectada'], 'string', 'max' => 250],
            [['id_modificado'], 'string', 'max' => 10],
           // [['IdUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['IdUsuario' => 'id']],
        */];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdTraza' => Yii::t('app', 'Id Traza'),
            'IdUsuario' => Yii::t('app', 'Id Usuario'),
            'ip' => Yii::t('app', 'Ip'),
            'tarea_realizada' => Yii::t('app', 'Tarea Realizada'),
            'Tabla_Afectada' => Yii::t('app', 'Tabla Afectada'),
            'fecha' => Yii::t('app', 'Fecha'),
            'hora' => Yii::t('app', 'Hora'),
            'id_modificado' => Yii::t('app', 'Id Modificado'),
            'valor_antiguo' => Yii::t('app', 'Valor Antiguo'),
            'valor_actual' => Yii::t('app', 'Valor Actual'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'IdUsuario']);
    }
}
