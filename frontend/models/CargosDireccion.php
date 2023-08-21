<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cargos_direccion".
 *
 * @property int $id
 * @property string $tipo
 * @property int $status
 *
 * @property Directivo[] $directivos
 */
class CargosDireccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cargos_direccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 255],
            [['tipo'], 'unique'],
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
    public function getDirectivos()
    {
        return $this->hasMany(Directivo::className(), ['cargos_direccionid' => 'id']);
    }
}
