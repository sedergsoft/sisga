<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trayectoria_militar".
 *
 * @property int $id
 * @property string $grado_militar
 *
 * @property Cuadro[] $cuadros
 * @property PreparacionMilitar[] $preparacionMilitars
 * @property TrayectoriaMilitarMilitancia[] $trayectoriaMilitarMilitancias
 */
class TrayectoriaMilitar extends \yii\db\ActiveRecord
{
     const SCENARIO_CREATE_TRAYECTORIA_MILITAR = 'CTrayectoriamilitar';
        public $active = 0;
  
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trayectoria_militar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grado_militar'], 'required','on'=> self::SCENARIO_CREATE_TRAYECTORIA_MILITAR],
            [['grado_militar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'grado_militar' => Yii::t('app', 'Grado Militar'),
            'active' => Yii::t('app', 'Trayectoria Militar'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['trayectoria_militarid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparacionMilitars()
    {
        return $this->hasMany(PreparacionMilitar::className(), ['trayectoria_militarid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaMilitarMilitancias()
    {
        return $this->hasMany(TrayectoriaMilitarMilitancia::className(), ['trayectoria_militarid' => 'id']);
    }
}
