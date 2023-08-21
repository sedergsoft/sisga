<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_proyeccion".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property Proyeccion[] $proyeccions
 */
class TipoProyeccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_proyeccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
    public function getProyeccions()
    {
        return $this->hasMany(Proyeccion::className(), ['tipo_proyeccionid' => 'id']);
    }
}
