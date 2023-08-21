<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "estado_salud".
 *
 * @property int $id
 * @property string $estado_salud
 *
 * @property Salud[] $saluds
 */
class EstadoSalud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado_salud'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'estado_salud' => Yii::t('app', 'Estado de Salud'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaluds()
    {
        return $this->hasMany(Salud::className(), ['estado_saludid' => 'id']);
    }
}
