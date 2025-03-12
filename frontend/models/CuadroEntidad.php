<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cuadro_entidad".
 *
 * @property int $id
 * @property int $cuadro_id
 * @property int $entidad_id
 *
 * @property Cuadro $cuadro
 * @property Entidad $entidad
 */
class CuadroEntidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuadro_entidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cuadro_id', 'entidad_id'], 'required'],
            [['cuadro_id', 'entidad_id'], 'integer'],
            [['cuadro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadro_id' => 'id']],
            [['entidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entidad::className(), 'targetAttribute' => ['entidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cuadro_id' => Yii::t('app', 'Cuadro ID'),
            'entidad_id' => Yii::t('app', 'Entidad ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntidad()
    {
        return $this->hasOne(Entidad::className(), ['id' => 'entidad_id']);
    }
}
