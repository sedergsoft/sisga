<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lugares_residencia".
 *
 * @property int $id
 * @property int $cuadroid
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property int $direccionesid
 * @property string $actual
 * 
 *
 * @property Direcciones $direcciones
 * @property Cuadro $cuadro
 */
class LugaresResidencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lugares_residencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'fecha_inicio'], 'required'],
            [['cuadroid','actual', 'direccionesid'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
           // [['actual'],'string'],
            [['direccionesid'], 'exist', 'skipOnError' => true, 'targetClass' => Direcciones::className(), 'targetAttribute' => ['direccionesid' => 'id']],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cuadroid' => Yii::t('app', 'Cuadroid'),
            'fecha_inicio' => Yii::t('app', 'Desde'),
            'fecha_fin' => Yii::t('app', 'Hasta'),
            'direccionesid' => Yii::t('app', 'Direccionesid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirecciones()
    {
        return $this->hasOne(Direcciones::className(), ['id' => 'direccionesid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }
}
