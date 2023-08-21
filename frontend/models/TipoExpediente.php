<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_expediente".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property PerdidaInvestigacion[] $perdidaInvestigacions
 * @property PerdidaInvestigacion[] $perdidaInvestigacions0
 */
class TipoExpediente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_expediente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo' => Yii::t('app', 'Tipo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerdidaInvestigacions()
    {
        return $this->hasMany(PerdidaInvestigacion::className(), ['tipo_expedienteid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerdidaInvestigacions0()
    {
        return $this->hasMany(PerdidaInvestigacion::className(), ['tipo_expedienteid' => 'id']);
    }
}
