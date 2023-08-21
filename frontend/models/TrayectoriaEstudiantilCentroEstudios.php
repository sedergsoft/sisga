<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trayectoria_estudiantil_centro_estudios".
 *
 * @property int $trayectoria_estudiantilid
 * @property int $centro_estudiosid
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * 
 *
 * @property TrayectoriaEstudiantil $trayectoriaEstudiantil
 *
 * @property CentroEstudios $centroEstudios
 * 
 */
class TrayectoriaEstudiantilCentroEstudios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trayectoria_estudiantil_centro_estudios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'fecha_inicio'], 'required'],
            [['trayectoria_estudiantilid', 'centro_estudiosid'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['trayectoria_estudiantilid', 'centro_estudiosid'], 'unique', 'targetAttribute' => ['trayectoria_estudiantilid', 'centro_estudiosid']],
            [['trayectoria_estudiantilid'], 'exist', 'skipOnError' => true, 'targetClass' => TrayectoriaEstudiantil::className(), 'targetAttribute' => ['trayectoria_estudiantilid' => 'id']],
            [['trayectoria_estudiantilid'], 'exist', 'skipOnError' => true, 'targetClass' => TrayectoriaEstudiantil::className(), 'targetAttribute' => ['trayectoria_estudiantilid' => 'id']],
            [['centro_estudiosid'], 'exist', 'skipOnError' => true, 'targetClass' => CentroEstudios::className(), 'targetAttribute' => ['centro_estudiosid' => 'id']],
            [['centro_estudiosid'], 'exist', 'skipOnError' => true, 'targetClass' => CentroEstudios::className(), 'targetAttribute' => ['centro_estudiosid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'trayectoria_estudiantilid' => Yii::t('app', 'Trayectoria Estudiantilid'),
            'centro_estudiosid' => Yii::t('app', 'Centro Estudiosid'),
            'fecha_inicio' => Yii::t('app', 'Fecha de Inicio'),
            'fecha_fin' => Yii::t('app', 'Fecha de Fin'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaEstudiantil()
    {
        return $this->hasOne(TrayectoriaEstudiantil::className(), ['id' => 'trayectoria_estudiantilid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   
    public function getCentroEstudios()
    {
        return $this->hasOne(CentroEstudios::className(), ['id' => 'centro_estudiosid']);
    }

   
}
