<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "miitancia_politic_cuadro".
 *
 * @property int $miitancia_politicid
 * @property int $cuadroid
 *
 * @property MiitanciaPolitic $miitanciaPolitic
 */
class MiitanciaPoliticCuadro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'miitancia_politic_cuadro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['miitancia_politicid'], 'required'],
            [['miitancia_politicid', 'cuadroid'], 'integer'],
          //  [['miitancia_politicid'], 'unique', 'targetAttribute' => ['miitancia_politicid', 'cuadroid']],
            [['miitancia_politicid'], 'exist', 'skipOnError' => true, 'targetClass' => MiitanciaPolitic::className(), 'targetAttribute' => ['miitancia_politicid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'miitancia_politicid' => Yii::t('app', 'Militancia Politica'),
            'cuadroid' => Yii::t('app', 'Cuadroid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMiitanciaPolitic()
    {
        return $this->hasOne(MiitanciaPolitic::className(), ['id' => 'miitancia_politicid']);
    }
}
