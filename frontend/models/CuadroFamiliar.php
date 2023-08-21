<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cuadro_familiar".
 *
 * @property int $cuadroid
 * @property int $familiarid
 *
 * @property Cuadro $cuadro
 * @property Familiar $familiar
 */
class CuadroFamiliar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuadro_familiar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cuadroid', 'familiarid'], 'required'],
            [['cuadroid', 'familiarid'], 'integer'],
            [['cuadroid', 'familiarid'], 'unique', 'targetAttribute' => ['cuadroid', 'familiarid']],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
            [['familiarid'], 'exist', 'skipOnError' => true, 'targetClass' => Familiar::className(), 'targetAttribute' => ['familiarid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cuadroid' => Yii::t('app', 'Cuadroid'),
            'familiarid' => Yii::t('app', 'Familiarid'),
        ];
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
    public function getFamiliar()
    {
        return $this->hasOne(Familiar::className(), ['id' => 'familiarid']);
    }
}
