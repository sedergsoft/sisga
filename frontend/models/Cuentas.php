<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cuentas".
 *
 * @property double $representatividad
 * @property int $id
 * @property double $total_cuentas_vencidas
 * @property int $no_vencidas
 * @property double $saldo_sentencias_judiciales
 * @property int $empresaid
 * @property double $cxc_litigio
 * @property double $nm_no_vencida
 * @property double $efectos
 * @property double $mn_total_vencida
 * @property double $ExC_litigio
 * @property double $ventas_acumuladas
 * @property string $fecha
 * @property int $tipo_cuentaid
 * @property double $efectiviadad
 * @property int $vencidas
 * @property int $anexoid
 *
 * @property TipoCuenta $tipoCuenta
 * @property Empresa $empresa
 */
class Cuentas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuentas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['representatividad', 'total_cuentas_vencidas', 'saldo_sentencias_judiciales', 'cxc_litigio', 'nm_no_vencida', 'efectos', 'mn_total_vencida', 'ExC_litigio', 'ventas_acumuladas', 'efectiviadad'], 'number'],
            [['no_vencidas', 'empresaid', 'tipo_cuentaid', 'vencidas', 'anexoid'], 'integer'],
            [['empresaid', 'tipo_cuentaid', 'anexoid'], 'required'],
            [['fecha'], 'safe'],
            [['tipo_cuentaid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCuenta::className(), 'targetAttribute' => ['tipo_cuentaid' => 'id']],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'representatividad' => Yii::t('app', 'Representatividad'),
            'id' => Yii::t('app', 'ID'),
            'total_cuentas_vencidas' => Yii::t('app', 'Total Cuentas Vencidas'),
            'no_vencidas' => Yii::t('app', 'No Vencidas'),
            'saldo_sentencias_judiciales' => Yii::t('app', 'Saldo Sentencias Judiciales'),
            'empresaid' => Yii::t('app', 'Empresaid'),
            'cxc_litigio' => Yii::t('app', 'Cxc Litigio'),
            'nm_no_vencida' => Yii::t('app', 'Nm No Vencida'),
            'efectos' => Yii::t('app', 'Efectos'),
            'mn_total_vencida' => Yii::t('app', 'Mn Total Vencida'),
            'ExC_litigio' => Yii::t('app', 'Ex C Litigio'),
            'ventas_acumuladas' => Yii::t('app', 'Ventas Acumuladas'),
            'fecha' => Yii::t('app', 'Fecha'),
            'tipo_cuentaid' => Yii::t('app', 'Tipo Cuentaid'),
            'efectiviadad' => Yii::t('app', 'Efectiviadad'),
            'vencidas' => Yii::t('app', 'Vencidas'),
            'anexoid' => Yii::t('app', 'Anexoid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCuenta()
    {
        return $this->hasOne(TipoCuenta::className(), ['id' => 'tipo_cuentaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresaid']);
    }
}
