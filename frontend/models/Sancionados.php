<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sancionados".
 *
 * @property int $id
 * @property string $sancion
 * @property string $fecha
 * @property string $motivo
 * @property int $familiarid
 *
 * @property Familiar $familiar
 */
class Sancionados extends \yii\db\ActiveRecord
{
   const SCENARIO_CREATE_SANCIONADOS = 'CSancionados';
 
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sancionados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sancion', 'fecha', 'motivo'], 'required','on'=>self::SCENARIO_CREATE_SANCIONADOS],
            [['fecha'], 'safe'],
            [['familiarid'], 'integer'],
            [['sancion'], 'string', 'max' => 255],
            [['motivo'], 'string', 'max' => 1000],
            //[['familiarid'], 'exist', 'skipOnError' => true, 'targetClass' => Familiar::className(), 'targetAttribute' => ['familiarid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sancion' => Yii::t('app', 'Sancion'),
            'fecha' => Yii::t('app', 'Fecha'),
            'motivo' => Yii::t('app', 'Motivo'),
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
