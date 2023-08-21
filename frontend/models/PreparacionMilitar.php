<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "preparacion_militar".
 *
 * @property int $id
 * @property string $escuela
 * @property string $curso
 * @property string $fecha
 * @property int $trayectoria_militarid
 *
 * @property TrayectoriaMilitar $trayectoriaMilitar
 */
class PreparacionMilitar extends \yii\db\ActiveRecord
{
   const SCENARIO_CREATE_PREPARACION_MILITAR = 'CPreparacionmilitar';
   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preparacion_militar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'trayectoria_militarid'], 'required','on'=> self::SCENARIO_CREATE_PREPARACION_MILITAR],
            [['fecha'], 'safe'],
            [['trayectoria_militarid'], 'integer'],
            [['escuela', 'curso'], 'string', 'max' => 255],
            [['trayectoria_militarid'], 'exist', 'skipOnError' => true, 'targetClass' => TrayectoriaMilitar::className(), 'targetAttribute' => ['trayectoria_militarid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'escuela' => Yii::t('app', 'Escuela'),
            'curso' => Yii::t('app', 'Curso'),
            'fecha' => Yii::t('app', 'Fecha'),
            'trayectoria_militarid' => Yii::t('app', 'Trayectoria Militarid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaMilitar()
    {
        return $this->hasOne(TrayectoriaMilitar::className(), ['id' => 'trayectoria_militarid']);
    }
}
