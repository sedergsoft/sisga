<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "estado_cumplimiento".
 *
 * @property int $id
 * @property string $estado
 *
 * @property Cumplimiento[] $cumplimientos
 */
class EstadoCumplimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_cumplimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'estado' => Yii::t('app', 'Estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCumplimientos()
    {
        return $this->hasMany(Cumplimiento::className(), ['estado_cumplimientoid' => 'id']);
    }
}
