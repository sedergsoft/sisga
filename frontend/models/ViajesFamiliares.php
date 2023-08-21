<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "viajes_familiares".
 *
 * @property int $id
 * @property string $fecha
 * @property string $pais
 * @property int $familiarid
 *
 * @property Familiar $familiar
 */
class ViajesFamiliares extends \yii\db\ActiveRecord
{
  const SCENARIO_CREATE_VIAJES_FAMILIARES = 'CViajesfamiliares';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'viajes_familiares';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'pais', 'familiarid'], 'required','on'=>self::SCENARIO_CREATE_VIAJES_FAMILIARES],
            [['fecha'], 'safe'],
            [['familiarid'], 'integer'],
            [['pais'], 'string', 'max' => 255],
            [['familiarid'], 'exist', 'skipOnError' => true, 'targetClass' => Familiar::className(), 'targetAttribute' => ['familiarid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha' => Yii::t('app', 'Fecha'),
            'pais' => Yii::t('app', 'Pais'),
            'familiarid' => Yii::t('app', 'Familiarid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliar()
    {
        return $this->hasOne(Familiar::className(), ['id' => 'familiarid']);
    }
}
