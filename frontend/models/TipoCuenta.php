<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_cuenta".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property Cuentas[] $cuentas
 */
class TipoCuenta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_cuenta';
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
    public function getCuentas()
    {
        return $this->hasMany(Cuentas::className(), ['tipo_cuentaid' => 'id']);
    }
}
