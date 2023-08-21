<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "organismo".
 *
 * @property int $idorganismo
 * @property string $organismo
 * @property int $Status
 * 
 *
 * @property CentroTrabajo[] $centroTrabajos
 */
class Organismo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organismo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['organismo'], 'required'],
            [['organismo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idorganismo' => Yii::t('app', 'id'),
            'organismo' => Yii::t('app', 'Organismo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroTrabajos()
    {
        return $this->hasMany(CentroTrabajo::className(), ['idorganismo' => 'idorganismo']);
    }
}
