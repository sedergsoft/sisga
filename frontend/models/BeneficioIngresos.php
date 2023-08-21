<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "beneficio_ingresos".
 *
 * @property int $familiarid
 * @property int $ingresos_monetariosid
 * @property int $cuadroid
 * @property int $id
 *
 * @property Familiar $familiar
 * @property Cuadro $cuadro
 * @property IngresosMonetarios $ingresosMonetarios
 */
class BeneficioIngresos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'beneficio_ingresos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['familiarid', 'ingresos_monetariosid', 'cuadroid', 'id'], 'required'],
            [['familiarid', 'ingresos_monetariosid', 'cuadroid', 'id'], 'integer'],
            [['id'], 'unique'],
            [['familiarid'], 'exist', 'skipOnError' => true, 'targetClass' => Familiar::className(), 'targetAttribute' => ['familiarid' => 'id']],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
            [['ingresos_monetariosid'], 'exist', 'skipOnError' => true, 'targetClass' => IngresosMonetarios::className(), 'targetAttribute' => ['ingresos_monetariosid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'familiarid' => Yii::t('app', 'Familiarid'),
            'ingresos_monetariosid' => Yii::t('app', 'Ingresos Monetariosid'),
            'cuadroid' => Yii::t('app', 'Cuadroid'),
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliar()
    {
        return $this->hasOne(Familiar::className(), ['id' => 'familiarid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngresosMonetarios()
    {
        return $this->hasOne(IngresosMonetarios::className(), ['id' => 'ingresos_monetariosid']);
    }
}
