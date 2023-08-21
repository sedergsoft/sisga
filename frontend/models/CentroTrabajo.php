<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "centro_trabajo".
 *
 * @property int $id
 * @property string $centro
 * @property int $direccionesid
 * @property string $telefono
 * @property string $email
 * @property int $idorganismo
 *
 * @property Organismo $organismo
 * @property Direcciones $direcciones
 * @property Cuadro[] $cuadros
 * @property TrayectoriaLaboral[] $trayectoriaLaborals
 */
class CentroTrabajo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'centro_trabajo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['centro', 'direccionesid', 'idorganismo'], 'required'],
            [['direccionesid', 'idorganismo'], 'integer'],
            [['centro'], 'string', 'max' => 125],
            [['telefono'], 'string', 'min' => 6,'max' => 12],
            [['email'],'email'],
            [['idorganismo'], 'exist', 'skipOnError' => true, 'targetClass' => Organismo::className(), 'targetAttribute' => ['idorganismo' => 'idorganismo']],
            [['direccionesid'], 'exist', 'skipOnError' => true, 'targetClass' => Direcciones::className(), 'targetAttribute' => ['direccionesid' => 'id']],
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
            'direccionesid' => Yii::t('app', 'Direccionesid'),
            'telefono' => Yii::t('app', 'Telefono'),
            'email' => Yii::t('app', 'Email'),
            'idorganismo' => Yii::t('app', 'Organismo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganismo()
    {
        return $this->hasOne(Organismo::className(), ['idorganismo' => 'idorganismo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirecciones()
    {
        return $this->hasOne(Direcciones::className(), ['id' => 'direccionesid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['centro_trabajoid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaLaborals()
    {
        return $this->hasMany(TrayectoriaLaboral::className(), ['centro_trabajoid' => 'id']);
    }
}
