<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trayectoria_estudiantil".
 *
 * @property int $id
 * @property int $cuadroid
 *
 * @property Cuadro $cuadro
 * @property TrayectoriaEstudiantilCentroEstudios[] $trayectoriaEstudiantilCentroEstudios
 * @property CentroEstudios[] $centroEstudios

 */
class TrayectoriaEstudiantil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trayectoria_estudiantil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cuadroid'], 'required'],
            [['cuadroid'], 'integer'],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cuadroid' => Yii::t('app', 'Cuadroid'),
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
    public function getTrayectoriaEstudiantilCentroEstudios()
    {
        return $this->hasMany(TrayectoriaEstudiantilCentroEstudios::className(), ['trayectoria_estudiantilid' => 'id']);
    }

  
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroEstudios()
    {
        return $this->hasMany(CentroEstudios::className(), ['id' => 'centro_estudiosid'])->viaTable('trayectoria_estudiantil_centro_estudios', ['trayectoria_estudiantilid' => 'id']);
    }

   
}
