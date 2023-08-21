<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "familiar_integracion".
 *
 * @property int $familiarid
 * @property int $integracionid
 *
 * @property Integracion $integracion
 * @property Familiar $familiar
 */
class FamiliarIntegracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'familiar_integracion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['familiarid', 'integracionid'], 'required'],
            [['familiarid', 'integracionid'], 'integer'],
            [['familiarid', 'integracionid'], 'unique', 'targetAttribute' => ['familiarid', 'integracionid']],
            [['integracionid'], 'exist', 'skipOnError' => true, 'targetClass' => Integracion::className(), 'targetAttribute' => ['integracionid' => 'id']],
            [['familiarid'], 'exist', 'skipOnError' => true, 'targetClass' => Familiar::className(), 'targetAttribute' => ['familiarid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'familiarid' => Yii::t('app', 'Familiarid'),
            'integracionid' => Yii::t('app', 'Integracionid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIntegracion()
    {
        return $this->hasOne(Integracion::className(), ['id' => 'integracionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliar()
    {
        return $this->hasOne(Familiar::className(), ['id' => 'familiarid']);
    }
}
