<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ingresos_monetarios".
 *
 * @property int $id
 * @property int $tipo_familiarid
 * @property int $tipo_ingresosid
 *
 * @property CuadroIngresosMonetarios[] $cuadroIngresosMonetarios
 * @property TipoIngresos $tipoIngresos
 * @property TipoFamiliar $tipoFamiliar
 */
class IngresosMonetarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingresos_monetarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_familiarid', 'tipo_ingresosid'], 'required'],
            [['tipo_familiarid', 'tipo_ingresosid'], 'integer'],
            [['tipo_ingresosid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoIngresos::className(), 'targetAttribute' => ['tipo_ingresosid' => 'id']],
            [['tipo_familiarid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoFamiliar::className(), 'targetAttribute' => ['tipo_familiarid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_familiarid' => Yii::t('app', 'Tipo de Familiar'),
            'tipo_ingresosid' => Yii::t('app', 'Tipo de Ingresos'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroIngresosMonetarios()
    {
        return $this->hasMany(CuadroIngresosMonetarios::className(), ['ingresos_monetariosid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoIngresos()
    {
        return $this->hasOne(TipoIngresos::className(), ['id' => 'tipo_ingresosid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoFamiliar()
    {
        return $this->hasOne(TipoFamiliar::className(), ['id' => 'tipo_familiarid']);
    }
}
