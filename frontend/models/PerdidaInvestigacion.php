<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "perdida_investigacion".
 *
 * @property int $id
 * @property double $importe_total
 * @property int $cant_expedientas
 * @property int $fuera_termino
 * @property double $valor_fuera_termino
 * @property int $tipo_expedienteid
 * @property int $empresaid
 * @property string $fecha
 * @property int $anexoid
 *
 * @property Empresa $empresa

 * @property TipoExpediente $tipoExpediente
 *
 */
class PerdidaInvestigacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perdida_investigacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['importe_total', 'valor_fuera_termino'], 'number'],
            [['cant_expedientas', 'fuera_termino', 'tipo_expedienteid', 'empresaid', 'anexoid'], 'integer'],
            [['tipo_expedienteid', 'empresaid', 'anexoid'], 'required'],
            [['fecha'], 'safe'],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
            [['tipo_expedienteid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoExpediente::className(), 'targetAttribute' => ['tipo_expedienteid' => 'id']],
            [['tipo_expedienteid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoExpediente::className(), 'targetAttribute' => ['tipo_expedienteid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'importe_total' => Yii::t('app', 'Importe Total'),
            'cant_expedientas' => Yii::t('app', 'Cant Expedientas'),
            'fuera_termino' => Yii::t('app', 'Fuera Termino'),
            'valor_fuera_termino' => Yii::t('app', 'Valor Fuera Termino'),
            'tipo_expedienteid' => Yii::t('app', 'Tipo Expedienteid'),
            'empresaid' => Yii::t('app', 'Empresaid'),
            'fecha' => Yii::t('app', 'Fecha'),
            'anexoid' => Yii::t('app', 'Anexoid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresaid']);
    }

   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoExpediente()
    {
        return $this->hasOne(TipoExpediente::className(), ['id' => 'tipo_expedienteid']);
    }

   
}
