<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "condecoraciones".
 *
 * @property int $id
 * @property string $nombre
 * @property string $fecha
 * @property int $cuadroid
 *
 * @property Cuadro $cuadro
 */
class Condecoraciones extends \yii\db\ActiveRecord
{
      public $active = 0; 
      const SCENARIO_CREATE_CONDECORACIONES = 'CCondecoraciones';

    public static function tableName()
    {
        return 'condecoraciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required', 'on' => self::SCENARIO_CREATE_CONDECORACIONES],
            [['cuadroid'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
            [['active'],'safe']
           
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'cuadroid' => Yii::t('app', 'Cuadro'),
            'active' => Yii::t('app', 'Condecoraciones,distinciones y  estimulos'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }
}
