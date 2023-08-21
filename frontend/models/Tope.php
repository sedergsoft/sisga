<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tope".
 *
 * @property int $id
 * @property double $Itrimestre
 * @property double $IItrimestre
 * @property double $IIItrimestre
 * @property double $IVtrimestre
 *
 * @property Criteriomedida[] $criteriomedidas
 */
class Tope extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tope';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Itrimestre', 'IItrimestre', 'IIItrimestre', 'IVtrimestre'], 'required'],
            [['Itrimestre', 'IItrimestre', 'IIItrimestre', 'IVtrimestre'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Itrimestre' => Yii::t('app', 'I trimestre'),
            'IItrimestre' => Yii::t('app', 'II trimestre'),
            'IIItrimestre' => Yii::t('app', 'III trimestre'),
            'IVtrimestre' => Yii::t('app', 'IV trimestre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCriteriomedidas()
    {
        return $this->hasMany(Criteriomedida::className(), ['topeid' => 'id']);
    }
}
