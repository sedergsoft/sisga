<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cuadro_ingresos_monetarios".
 *
 * @property int $cuadroid
 * @property int $ingresos_monetariosid
 * @property int $id
 * @property int $status
 *
 * @property IngresosMonetarios $ingresosMonetarios
 * @property Cuadro $cuadro
 */
class CuadroIngresosMonetarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuadro_ingresos_monetarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cuadroid', 'ingresos_monetariosid'], 'required'],
            [['cuadroid', 'ingresos_monetariosid'], 'integer'],
            [['ingresos_monetariosid'], 'exist', 'skipOnError' => true, 'targetClass' => IngresosMonetarios::className(), 'targetAttribute' => ['ingresos_monetariosid' => 'id']],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cuadroid' => Yii::t('app', 'Cuadroid'),
            'ingresos_monetariosid' => Yii::t('app', 'Ingresos Monetariosid'),
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngresosMonetarios()
    {
        return $this->hasOne(IngresosMonetarios::className(), ['id' => 'ingresos_monetariosid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }
}
