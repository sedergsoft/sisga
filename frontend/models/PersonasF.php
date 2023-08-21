<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property string $CI
 * @property string $Nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $sexo
 *
 * @property Cuadro[] $cuadros
 * @property Familiar[] $familiars
 * @property RelacionesExterior[] $relacionesExteriors
 */
class PersonasF extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CI', 'Nombre', 'primer_apellido', 'segundo_apellido', 'sexo'], 'required'],
            [['CI'], 'string', 'max' => 11],
            [['Nombre', 'primer_apellido', 'segundo_apellido'], 'string', 'max' => 255],
            [['sexo'], 'string', 'max' => 1],
            [['CI'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CI' => Yii::t('app', 'Ci'),
            'Nombre' => Yii::t('app', 'Nombre'),
            'primer_apellido' => Yii::t('app', 'Primer Apellido'),
            'segundo_apellido' => Yii::t('app', 'Segundo Apellido'),
            'sexo' => Yii::t('app', 'Sexo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['personaCI' => 'CI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliars()
    {
        return $this->hasMany(Familiar::className(), ['personaCI' => 'CI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacionesExteriors()
    {
        return $this->hasMany(RelacionesExterior::className(), ['personaCI' => 'CI']);
    }
}
