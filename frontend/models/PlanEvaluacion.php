<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "plan_evaluacion".
 *
 * @property int $id
 * @property int $idevaluador
 * @property int $idcuadro
 * @property string $fecha
 * @property int $status
 * @property int $ultima
 * @property string $observaciones
 *
 * @property Cuadro $cuadro
 * @property User $evaluador
 */
class PlanEvaluacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_evaluacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idevaluador', 'idcuadro', 'fecha'], 'required'],
            [['idevaluador', 'idcuadro', 'status', 'ultima'], 'integer'],
            [['fecha'], 'safe'],
            [['observaciones'], 'string'],
            [['idcuadro'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['idcuadro' => 'id']],
            [['idevaluador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idevaluador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
             'idevaluador' => Yii::t('app', 'Evaluador'),
           'idcuadro' => Yii::t('app', 'Cuadro a Evaluar'),
            'fecha' => Yii::t('app', 'Fecha'),
            'status' => Yii::t('app', 'Status'),
            'ultima' => Yii::t('app', 'Ultima'),
            'observaciones' => Yii::t('app', 'Observaciones'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'idcuadro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluador()
    {
        return $this->hasOne(User::className(), ['id' => 'idevaluador']);
    }
}
