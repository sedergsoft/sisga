<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ciclos".
 *
 * @property int $CE      
 * @property int $CEL
 * @property int $CELD
 * @property int $CPCE
 * @property int $CPCED
 * @property int $id
 * @property int $empresaid
 * @property string $fecha
 * @property int $anexoid
 *
 * @property Empresa $empresa
 */
class Ciclos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ciclos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CE', 'CEL', 'CELD', 'CPCE', 'CPCED', 'empresaid', 'anexoid'], 'integer'],
            [['empresaid', 'anexoid'], 'required'],
            [['fecha'], 'safe'],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CE' => Yii::t('app', 'C E'),
            'CEL' => Yii::t('app', 'C E L'),
            'CELD' => Yii::t('app', 'C E L D'),
            'CPCE' => Yii::t('app', 'C P C E'),
            'CPCED' => Yii::t('app', 'C P C E D'),
            'id' => Yii::t('app', 'ID'),
            'empresaid' => Yii::t('app', 'Empresaid'),
            'fecha' => Yii::t('app', 'Fecha'),
            'anexoid' => Yii::t('app', 'Anexoid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresaid']);
    }
}
