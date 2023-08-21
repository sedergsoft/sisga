<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "direcciones".
 *
 * @property int $id
 * @property string $calle
 * @property string $numero
 * @property string $edif
 * @property string $apto
 * @property string $piso
 * @property string $entre_calle_uno
 * @property string $entre_calle_dos
 * @property string $Reparto
 * @property int $provinciaid
 * @property int $municipioid
 *
 * @property CentroTrabajo[] $centroTrabajos
 * @property Municipio $municipio
 * @property Provincia $provincia
 * @property LugaresResidencia[] $lugaresResidencias
 */
class Direcciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direcciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['calle', 'numero', 'entre_calle_uno', 'provinciaid', 'municipioid'], 'required'],
            [[ 'provinciaid', 'municipioid'], 'integer'],
            [['calle', 'numero', 'edif', 'apto', 'piso', 'entre_calle_dos','entre_calle_uno', 'Reparto'], 'string', 'max' => 255],
            [['municipioid'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['municipioid' => 'id']],
            [['provinciaid'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provinciaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'calle' => Yii::t('app', 'Calle'),
            'numero' => Yii::t('app', 'Numero'),
            'edif' => Yii::t('app', 'Edif'),
            'apto' => Yii::t('app', 'Apto'),
            'piso' => Yii::t('app', 'Piso'),
            'entre_calle_uno' => Yii::t('app', 'Entre Calle Uno'),
            'entre_calle_dos' => Yii::t('app', 'Entre Calle Dos'),
            'Reparto' => Yii::t('app', 'Reparto'),
            'provinciaid' => Yii::t('app', 'Provincia'),
            'municipioid' => Yii::t('app', 'Municipio'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroTrabajos()
    {
        return $this->hasMany(CentroTrabajo::className(), ['direccionesid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['id' => 'municipioid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['id' => 'provinciaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugaresResidencias()
    {
        return $this->hasMany(LugaresResidencia::className(), ['direccionesid' => 'id']);
    }
}
