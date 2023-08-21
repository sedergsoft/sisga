<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "categoria_docente".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property PreparacionIntelectual[] $preparacionIntelectuals
 */
class CategoriaDocente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria_docente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 100],
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
    public function getPreparacionIntelectuals()
    {
        return $this->hasMany(PreparacionIntelectual::className(), ['categoria_docente' => 'id']);
    }
}
