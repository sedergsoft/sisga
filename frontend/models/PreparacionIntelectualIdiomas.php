<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "preparacion_intelectual_idiomas".
 *
 * @property int $preparacion_intelectualid
 * @property int $idiomasid
 * @property int $nivel
 *
 * @property Idiomas $idiomas
 * @property PreparacionIntelectual $preparacionIntelectual
 */
class PreparacionIntelectualIdiomas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preparacion_intelectual_idiomas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'idiomasid','nivel'], 'required'],
            [['preparacion_intelectualid', 'idiomasid','nivel'], 'integer'],
            [['preparacion_intelectualid', 'idiomasid'], 'unique', 'targetAttribute' => ['preparacion_intelectualid', 'idiomasid']],
            [['idiomasid'], 'exist', 'skipOnError' => true, 'targetClass' => Idiomas::className(), 'targetAttribute' => ['idiomasid' => 'id']],
            [['preparacion_intelectualid'], 'exist', 'skipOnError' => true, 'targetClass' => PreparacionIntelectual::className(), 'targetAttribute' => ['preparacion_intelectualid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'preparacion_intelectualid' => Yii::t('app', 'Preparacion Intelectualid'),
            'idiomasid' => Yii::t('app', 'Idiomasid'),
            'nivel' => Yii::t('app', 'Nivel'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdiomas()
    {
        return $this->hasOne(Idiomas::className(), ['id' => 'idiomasid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparacionIntelectual()
    {
        return $this->hasOne(PreparacionIntelectual::className(), ['id' => 'preparacion_intelectualid']);
    }
}
