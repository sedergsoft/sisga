<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tope_indicador".
 *
 * @property int $id
 * @property string $valor
 * @property int $idsentido
 *
 * @property IndicadoresGestion[] $indicadoresGestions
 * @property Sentido $sentido
 */
class TopeIndicador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tope_indicador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor', 'idsentido'], 'required'],
            [['idsentido'], 'integer'],
            [['valor'], 'double'],
            [['idsentido'], 'exist', 'skipOnError' => true, 'targetClass' => Sentido::className(), 'targetAttribute' => ['idsentido' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'valor' => Yii::t('app', 'Valor'),
            'idsentido' => Yii::t('app', 'Sentido'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicadoresGestions()
    {
        return $this->hasMany(IndicadoresGestion::className(), ['topeid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentido()
    {
        return $this->hasOne(Sentido::className(), ['id' => 'idsentido']);
    }
}
