<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "limitaciones".
 *
 * @property int $id
 * @property string $limitacion
 *
 * @property LimitacionesSalud[] $limitacionesSaluds
 * @property Salud[] $saluds
 */
class Limitaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'limitaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['limitacion'], 'required'],
            [['limitacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'limitacion' => Yii::t('app', 'Limitacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitacionesSaluds()
    {
        return $this->hasMany(LimitacionesSalud::className(), ['limitacionesid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaluds()
    {
        return $this->hasMany(Salud::className(), ['id' => 'saludid'])->viaTable('limitaciones_salud', ['limitacionesid' => 'id']);
    }
}
