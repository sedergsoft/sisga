<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tegnologia_logistica".
 *
 * @property int $id
 * @property int $existencia
 * @property int $funcionando
 * @property double $porciento_disp
 * @property string $fecha
 * @property int $tipo_MTid
 *
 * @property Empresa[] $empresas
 * @property TipoMt $tipoMT
 * @property TipoMt $tipoMT0
 */
class TegnologiaLogistica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tegnologia_logistica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['existencia', 'funcionando', 'tipo_MTid'], 'integer'],
            [['porciento_disp'], 'number'],
            [['fecha'], 'safe'],
            [['tipo_MTid'], 'required'],
            [['tipo_MTid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMt::className(), 'targetAttribute' => ['tipo_MTid' => 'id']],
            [['tipo_MTid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMt::className(), 'targetAttribute' => ['tipo_MTid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'existencia' => Yii::t('app', 'Existencia'),
            'funcionando' => Yii::t('app', 'Funcionando'),
            'porciento_disp' => Yii::t('app', 'Porciento Disp'),
            'fecha' => Yii::t('app', 'Fecha'),
            'tipo_MTid' => Yii::t('app', 'Tipo M Tid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresas()
    {
        return $this->hasMany(Empresa::className(), ['tegnologia_logisticaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMT()
    {
        return $this->hasOne(TipoMt::className(), ['id' => 'tipo_MTid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMT0()
    {
        return $this->hasOne(TipoMt::className(), ['id' => 'tipo_MTid']);
    }
}
