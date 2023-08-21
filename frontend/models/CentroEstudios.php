<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "centro_estudios".
 *
 * @property int $id
 * @property string $centro
 * @property int $municipioid
 * @property int $provinciaid
 *
 * @property Municipio $municipio
 * @property Provincia $provincia
 * @property TrayectoriaEstudiantilCentroEstudios[] $trayectoriaEstudiantilCentroEstudios
 * @property TrayectoriaEstudiantil[] $trayectoriaEstudiantils

 */
class CentroEstudios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'centro_estudios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['centro', 'municipioid', 'provinciaid'], 'required'],
            [['municipioid', 'provinciaid'], 'integer'],
            [['centro'], 'string', 'max' => 255],
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
            'centro' => Yii::t('app', 'Centro'),
            'municipioid' => Yii::t('app', 'Municipio'),
            'provinciaid' => Yii::t('app', 'Provincia'),
        ];
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
    public function getTrayectoriaEstudiantilCentroEstudios()
    {
        return $this->hasMany(TrayectoriaEstudiantilCentroEstudios::className(), ['centro_estudiosid' => 'id']);
    }

 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaEstudiantils()
    {
        return $this->hasMany(TrayectoriaEstudiantil::className(), ['id' => 'trayectoria_estudiantilid'])->viaTable('trayectoria_estudiantil_centro_estudios', ['centro_estudiosid' => 'id']);
    }

   
}
