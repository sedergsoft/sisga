<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "limitaciones_salud".
 *
 * @property int $limitacionesid
 * @property int $saludid
 *
 * @property Salud $salud
 * @property Limitaciones $limitaciones
 */
class LimitacionesSalud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'limitaciones_salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['limitacionesid', 'saludid'], 'required'],
            [['limitacionesid', 'saludid'], 'integer'],
            [['limitacionesid', 'saludid'], 'unique', 'targetAttribute' => ['limitacionesid', 'saludid']],
            [['saludid'], 'exist', 'skipOnError' => true, 'targetClass' => Salud::className(), 'targetAttribute' => ['saludid' => 'id']],
            [['limitacionesid'], 'exist', 'skipOnError' => true, 'targetClass' => Limitaciones::className(), 'targetAttribute' => ['limitacionesid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'limitacionesid' => Yii::t('app', 'Limitacionesid'),
            'saludid' => Yii::t('app', 'Saludid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalud()
    {
        return $this->hasOne(Salud::className(), ['id' => 'saludid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitaciones()
    {
        return $this->hasOne(Limitaciones::className(), ['id' => 'limitacionesid']);
    }
}
