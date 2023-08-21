<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cuadro_escuela_politica".
 *
 * @property int $id
 * @property int $cuadroid
 * @property int $escuela_politicaid
 * @property string $curso
 * @property string $fecha
 *
 * @property Cuadro $cuadro
 * @property EscuelaPolitica $escuelaPolitica
 */
class CuadroEscuelaPolitica extends \yii\db\ActiveRecord
{
    public $active = 0;
    const SCENARIO_CREATE_ESCUELA_POLITICA = 'CEscuelapolitica';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuadro_escuela_politica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'curso', 'fecha'], 'required','on'=> self::SCENARIO_CREATE_ESCUELA_POLITICA],
            [['cuadroid', 'escuela_politicaid'], 'integer'],
            [['fecha'], 'safe'],
            [['curso'], 'string', 'max' => 255],
             [['active'],'safe']
           
         //   [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
          //  [['escuela_politicaid'], 'exist', 'skipOnError' => true, 'targetClass' => EscuelaPolitica::className(), 'targetAttribute' => ['escuela_politicaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cuadroid' => Yii::t('app', 'Cuadro'),
            'escuela_politicaid' => Yii::t('app', 'Escuela Politica'),
            'curso' => Yii::t('app', 'Curso'),
            'fecha' => Yii::t('app', 'Fecha'),
            'active' => Yii::t('app', 'Escuelas políticas cursadas'),
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
    public function getEscuelaPolitica()
    {
        return $this->hasOne(EscuelaPolitica::className(), ['id' => 'escuela_politicaid']);
    }
}
