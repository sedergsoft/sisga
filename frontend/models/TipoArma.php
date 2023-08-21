<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_arma".
 *
 * @property int $id
 * @property string $tipo_arma
 *
 * @property Armas[] $armas
 */
class TipoArma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_arma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_arma'], 'required'],
            [['tipo_arma'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_arma' => Yii::t('app', 'Tipo Arma'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmas()
    {
        return $this->hasMany(Armas::className(), ['tipo_armaid' => 'id']);
    }
}
