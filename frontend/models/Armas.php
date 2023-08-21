<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "armas".
 *
 * @property int $id
 * @property int $tipo_armaid
 * @property string $marca
 * @property string $modelo
 * @property string $no_licencia
 * @property string $tipo
 * @property int $cuadroid
 *
 * @property Cuadro $cuadro
 * @property TipoArma $tipoArma
 */
class Armas extends \yii\db\ActiveRecord
{
    public $active = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'armas';
    }
    const SCENARIO_CREATE_ARMA = 'CArma';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_armaid', 'marca', 'modelo', 'no_licencia', 'tipo'], 'required','on'=> self::SCENARIO_CREATE_ARMA],
            [['tipo_armaid', 'cuadroid'], 'integer'],
            [['marca', 'modelo', 'no_licencia', 'tipo'], 'string', 'max' => 255],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
            [['tipo_armaid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoArma::className(), 'targetAttribute' => ['tipo_armaid' => 'id']],
            [['active'],'safe']
            ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE_ARMA] = ['tipo_armaid', 'marca', 'modelo', 'no_licencia', 'tipo','cuadroid','id'];
      //  $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_armaid' => Yii::t('app', 'Tipo de Arma'),
            'marca' => Yii::t('app', 'Marca'),
            'modelo' => Yii::t('app', 'Modelo'),
            'no_licencia' => Yii::t('app', 'No Licencia'),
            'tipo' => Yii::t('app', 'Tipo'),
            'cuadroid' => Yii::t('app', 'Cuadroid'),
            'active' => Yii::t('app', 'Armas'),
            
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
    public function getTipoArma()
    {
        return $this->hasOne(TipoArma::className(), ['id' => 'tipo_armaid']);
    }
}
