<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trayectoria_militar_militancia".
 *
 * @property int $id
 * @property int $trayectoria_militarid
 * @property int $militanciaid
 * @property string $fecha_entrada
 * @property string $fecha_baja
 * @property string $causa_baja
 *
 * @property Militancia $militancia
 * @property TrayectoriaMilitar $trayectoriaMilitar
 */
class TrayectoriaMilitarMilitancia extends \yii\db\ActiveRecord
{
     const SCENARIO_CREATE_TRAYECTORIA_MILITAR_MILITANCIA = 'CTrayectoriaMilitarMili';
   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trayectoria_militar_militancia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trayectoria_militarid', 'militanciaid', 'fecha_entrada'], 'required','on'=>self::SCENARIO_CREATE_TRAYECTORIA_MILITAR_MILITANCIA],
            [['trayectoria_militarid', 'militanciaid'], 'integer'],
            [['fecha_entrada', 'fecha_baja'], 'safe'],
            [['causa_baja'], 'string', 'max' => 255],
            [['militanciaid'], 'exist', 'skipOnError' => true, 'targetClass' => Militancia::className(), 'targetAttribute' => ['militanciaid' => 'id']],
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
            'trayectoria_militarid' => Yii::t('app', 'Trayectoria Militarid'),
            'militanciaid' => Yii::t('app', 'Militancia'),
            'fecha_entrada' => Yii::t('app', 'Fecha Entrada'),
            'fecha_baja' => Yii::t('app', 'Fecha Baja'),
            'causa_baja' => Yii::t('app', 'Causa Baja'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMilitancia()
    {
        return $this->hasOne(Militancia::className(), ['id' => 'militanciaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaMilitar()
    {
        return $this->hasOne(TrayectoriaMilitar::className(), ['id' => 'trayectoria_militarid']);
    }
}
