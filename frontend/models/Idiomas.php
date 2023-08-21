<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "idiomas".
 *
 * @property int $id
 * @property string $idioma
 *
 * @property PreparacionIntelectualIdiomas[] $preparacionIntelectualIdiomas
 * @property PreparacionIntelectual[] $preparacionIntelectuals
 */
class Idiomas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'idiomas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idioma'], 'required'],
            [['idioma'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idioma' => Yii::t('app', 'Idioma'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparacionIntelectualIdiomas()
    {
        return $this->hasMany(PreparacionIntelectualIdiomas::className(), ['idiomasid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparacionIntelectuals()
    {
        return $this->hasMany(PreparacionIntelectual::className(), ['id' => 'preparacion_intelectualid'])->viaTable('preparacion_intelectual_idiomas', ['idiomasid' => 'id']);
    }
}
