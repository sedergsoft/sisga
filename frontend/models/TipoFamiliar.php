<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_familiar".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property Familiar[] $familiars
 */
class TipoFamiliar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_familiar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo' => Yii::t('app', 'Parentesco'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliars()
    {
        return $this->hasMany(Familiar::className(), ['tipo_familiar' => 'id']);
    }
}
