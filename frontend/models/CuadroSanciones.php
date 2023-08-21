<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cuadro_sanciones".
 *
 * @property int $sancionesid
 * @property int $cuadroid
 *
 * @property Cuadro $cuadro
 * @property Sanciones $sanciones
 */
class CuadroSanciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuadro_sanciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sancionesid', 'cuadroid'], 'required'],
            [['sancionesid', 'cuadroid'], 'integer'],
            [['sancionesid', 'cuadroid'], 'unique', 'targetAttribute' => ['sancionesid', 'cuadroid']],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
            [['sancionesid'], 'exist', 'skipOnError' => true, 'targetClass' => Sanciones::className(), 'targetAttribute' => ['sancionesid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sancionesid' => Yii::t('app', 'Sancionesid'),
            'cuadroid' => Yii::t('app', 'Cuadroid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSanciones()
    {
        return $this->hasOne(Sanciones::className(), ['id' => 'sancionesid']);
    }
}
