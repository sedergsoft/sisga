<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "militancia".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property TrayectoriaMilitarMilitancia[] $trayectoriaMilitarMilitancias
 */
class Militancia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'militancia';
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
            'tipo' => Yii::t('app', 'Tipo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaMilitarMilitancias()
    {
        return $this->hasMany(TrayectoriaMilitarMilitancia::className(), ['militanciaid' => 'id']);
    }
}
