<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property int $id
 * @property string $nombre
 * @property int $tegnologia_logisticaid
 *
 * @property Capital[] $capitals
 * @property Ciclos[] $ciclos
 * @property Comedor[] $comedors
 * @property Cuentas[] $cuentas
 * @property TegnologiaLogistica $tegnologiaLogistica
 * @property FondoSalario[] $fondoSalarios
 * @property FondoTiempo[] $fondoTiempos
 * @property FondoTiempo[] $fondoTiempos0
 * @property Impuesto[] $impuestos
 * @property Impuesto[] $impuestos0
 * @property Inventario[] $inventarios
 * @property Inventario[] $inventarios0
 * @property PerdidaInvestigacion[] $perdidaInvestigacions
 * @property PerdidaInvestigacion[] $perdidaInvestigacions0
 * @property Productividad[] $productividads
 * @property Productividad[] $productividads0
 * @property Utilidad[] $utilidads
 * @property Utilidad[] $utilidads0
 * @property Utilidadxpeso[] $utilidadxpesos
 * @property Utilidadxpeso[] $utilidadxpesos0
 * @property ValorAgregado[] $valorAgregados
 * @property ValorAgregado[] $valorAgregados0
 * @property VariacionGastos[] $variacionGastos
 * @property VariacionGastos[] $variacionGastos0
 * @property Ventas[] $ventas
 * @property Ventas[] $ventas0
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['tegnologia_logisticaid'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['tegnologia_logisticaid'], 'exist', 'skipOnError' => true, 'targetClass' => TegnologiaLogistica::className(), 'targetAttribute' => ['tegnologia_logisticaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'tegnologia_logisticaid' => Yii::t('app', 'Tegnologia Logisticaid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitals()
    {
        return $this->hasMany(Capital::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiclos()
    {
        return $this->hasMany(Ciclos::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComedors()
    {
        return $this->hasMany(Comedor::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentas()
    {
        return $this->hasMany(Cuentas::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTegnologiaLogistica()
    {
        return $this->hasOne(TegnologiaLogistica::className(), ['id' => 'tegnologia_logisticaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFondoSalarios()
    {
        return $this->hasMany(FondoSalario::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFondoTiempos()
    {
        return $this->hasMany(FondoTiempo::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFondoTiempos0()
    {
        return $this->hasMany(FondoTiempo::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImpuestos()
    {
        return $this->hasMany(Impuesto::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImpuestos0()
    {
        return $this->hasMany(Impuesto::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios0()
    {
        return $this->hasMany(Inventario::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerdidaInvestigacions()
    {
        return $this->hasMany(PerdidaInvestigacion::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerdidaInvestigacions0()
    {
        return $this->hasMany(PerdidaInvestigacion::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductividads()
    {
        return $this->hasMany(Productividad::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductividads0()
    {
        return $this->hasMany(Productividad::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilidads()
    {
        return $this->hasMany(Utilidad::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilidads0()
    {
        return $this->hasMany(Utilidad::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilidadxpesos()
    {
        return $this->hasMany(Utilidadxpeso::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilidadxpesos0()
    {
        return $this->hasMany(Utilidadxpeso::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValorAgregados()
    {
        return $this->hasMany(ValorAgregado::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValorAgregados0()
    {
        return $this->hasMany(ValorAgregado::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariacionGastos()
    {
        return $this->hasMany(VariacionGastos::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariacionGastos0()
    {
        return $this->hasMany(VariacionGastos::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::className(), ['empresaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas0()
    {
        return $this->hasMany(Ventas::className(), ['empresaid' => 'id']);
    }
}
