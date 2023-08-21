<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "familiar".
 *
 * @property int $id
 * @property int $tipo_familiar
 * @property string $personaCI
 * @property string $centro_estudio_trabajo
 * @property int $conviviente
 * @property int $sancionado
 * @property int $viaje
 * @property int $residenteExterior
 * @property int $active
 *
 * @property BeneficioIngresos[] $beneficioIngresos
 * @property CuadroFamiliar[] $cuadroFamiliars
 * @property Cuadro[] $cuadros
 * @property Persona $personaCI0
 * @property TipoFamiliar $tipoFamiliar
 * @property FamiliarIntegracion[] $familiarIntegracions
 * @property Integracion[] $integracions
 * @property FamiliaresExterior[] $familiaresExteriors
 * @property Sancionados[] $sancionados
 * @property ViajesFamiliares[] $viajesFamiliares
 */
class Familiar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'familiar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_familiar', 'personaCI', 'centro_estudio_trabajo'], 'required'],
           [['tipo_familiar', 'conviviente', 'sancionado','viaje','residenteExterior'], 'integer'],
            [['personaCI'], 'string', 'max' => 11],
            [['centro_estudio_trabajo'], 'string', 'max' => 255],
       //     [['personaCI'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['personaCI' => 'CI']],
           [['tipo_familiar'], 'exist', 'skipOnError' => true, 'targetClass' => TipoFamiliar::className(), 'targetAttribute' => ['tipo_familiar' => 'id']],
       ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_familiar' => Yii::t('app', 'Tipo Familiar'),
            'personaCI' => Yii::t('app', 'Persona Ci'),
            'centro_estudio_trabajo' => Yii::t('app', 'Centro De Estudio o Trabajo'),
            'conviviente' => Yii::t('app', 'Conviviente'),
            'sancionado' => Yii::t('app', 'Sancionado'),
            'viaje' => Yii::t('app', 'Viajes'),
            'residenteExterior' => Yii::t('app', 'Residente en el Exterior'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeneficioIngresos()
    {
        return $this->hasMany(BeneficioIngresos::className(), ['familiarid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroFamiliars()
    {
        return $this->hasMany(CuadroFamiliar::className(), ['familiarid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['id' => 'cuadroid'])->viaTable('cuadro_familiar', ['familiarid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaCI0()
    {
        return $this->hasOne(Persona::className(), ['CI' => 'personaCI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoFamiliar()
    {
        return $this->hasOne(TipoFamiliar::className(), ['id' => 'tipo_familiar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliarIntegracions()
    {
        return $this->hasMany(FamiliarIntegracion::className(), ['familiarid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIntegracions()
    {
        return $this->hasMany(Integracion::className(), ['id' => 'integracionid'])->viaTable('familiar_integracion', ['familiarid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliaresExteriors()
    {
        return $this->hasMany(FamiliaresExterior::className(), ['familiarid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSancionados()
    {
        return $this->hasMany(Sancionados::className(), ['familiarid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViajesFamiliares()
    {
        return $this->hasMany(ViajesFamiliares::className(), ['familiarid' => 'id']);
    }
}
