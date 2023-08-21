<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ventas".
 *
 * @property int $id
 * @property double $plan
 * @property double $vreal
 * @property int $productoid
 * @property int $tipo_ventaid
 * @property int $empresaid
 * @property string $fecha
 * @property int $anexoid
 * 
 * @property Empresa $empresa

 * @property TipoVenta $tipoVenta

 * @property Producto $producto

 */
class Ventas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ventas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['plan', 'vreal'], 'number'],
            /*[['productoid', 'tipo_ventaid', 'empresaid', 'fecha'], 'required'],
            [['productoid', 'tipo_ventaid', 'empresaid'], 'integer'],
            [['fecha'], 'safe'],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
           [['tipo_ventaid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoVenta::className(), 'targetAttribute' => ['tipo_ventaid' => 'id']],
            [['productoid'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['productoid' => 'id']],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'plan' => Yii::t('app', 'Plan'),
            'vreal' => Yii::t('app', 'Vreal'),
            'productoid' => Yii::t('app', 'Productoid'),
            'tipo_ventaid' => Yii::t('app', 'Tipo Ventaid'),
            'empresaid' => Yii::t('app', 'Empresaid'),
            'fecha' => Yii::t('app', 'Fecha'),
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
    public function getTipoVenta()
    {
        return $this->hasOne(TipoVenta::className(), ['id' => 'tipo_ventaid']);
    }

  
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'productoid']);
    }

   
}
