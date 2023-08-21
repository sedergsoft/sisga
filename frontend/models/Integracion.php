<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "integracion".
 *
 * @property int $id
 * @property string $organizacion
 *
 * @property FamiliarIntegracion[] $familiarIntegracions
 * @property Familiar[] $familiars
 */
class Integracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'integracion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['organizacion'], 'required'],
            [['organizacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'organizacion' => Yii::t('app', 'Organizacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliarIntegracions()
    {
        return $this->hasMany(FamiliarIntegracion::className(), ['integracionid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliars()
    {
        return $this->hasMany(Familiar::className(), ['id' => 'familiarid'])->viaTable('familiar_integracion', ['integracionid' => 'id']);
    }
}
