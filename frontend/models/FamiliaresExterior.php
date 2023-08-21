<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "familiares_exterior".
 *
 * @property int $id
 * @property string $pais
 * @property string $nacionalidad
 * @property int $familiarid
 *
 * @property Familiar $familiar
 */
class FamiliaresExterior extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_CREATE_FAMILIAR_EXTERIOR = 'CFamliarExterior';

    
    public static function tableName()
    {
        return 'familiares_exterior';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pais', 'nacionalidad'], 'required','on'=>self::SCENARIO_CREATE_FAMILIAR_EXTERIOR],
            [['familiarid'], 'integer'],
            [['pais', 'nacionalidad'], 'string', 'max' => 255],
            [['familiarid'], 'exist', 'skipOnError' => true, 'targetClass' => Familiar::className(), 'targetAttribute' => ['familiarid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pais' => Yii::t('app', 'Pais'),
            'nacionalidad' => Yii::t('app', 'Nacionalidad'),
            'familiarid' => Yii::t('app', 'Familiarid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliar()
    {
        return $this->hasOne(Familiar::className(), ['id' => 'familiarid']);
    }
}
