<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_ingresos".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property IngresosMonetarios[] $ingresosMonetarios
 */
class TipoIngresos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_ingresos';
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
    public function getIngresosMonetarios()
    {
        return $this->hasMany(IngresosMonetarios::className(), ['tipo_ingresosid' => 'id']);
    }
}
