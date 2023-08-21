<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "miitancia_politic".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property MiitanciaPoliticCuadro[] $miitanciaPoliticCuadros
 */
class MiitanciaPolitic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'miitancia_politic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
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
    public function getMiitanciaPoliticCuadros()
    {
        return $this->hasMany(MiitanciaPoliticCuadro::className(), ['miitancia_politicid' => 'id']);
    }
}
