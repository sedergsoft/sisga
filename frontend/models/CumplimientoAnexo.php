<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cumplimiento_anexo".
 *
 * @property int $cumplimientoid
 * @property int $anexoid
 * @property string $fecha
 * @property string $anexo
 * @property string $nombre
 * @property int $idtabla
 * @property int $id
 * @property int $status
 *
 * @property Anexo $anexo0
 * @property Cumplimiento $cumplimiento
 */
class CumplimientoAnexo extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cumplimiento_anexo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['cumplimientoid', 'anexoid', 'anexo', 'idtabla'], 'required'],
            [['cumplimientoid', 'anexoid', 'idtabla'], 'integer'],
            [['fecha'], 'safe'],
            [['file'],'safe'],
          //  [['file'],'file','extensions'=>'docx'],
            [['anexo','nombre'], 'string', 'max' => 500],
           // [['anexoid'], 'exist', 'skipOnError' => true, 'targetClass' => Anexo::className(), 'targetAttribute' => ['anexoid' => 'id']],
           // [['cumplimientoid'], 'exist', 'skipOnError' => true, 'targetClass' => Cumplimiento::className(), 'targetAttribute' => ['cumplimientoid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cumplimientoid' => Yii::t('app', 'Cumplimientoid'),
            'anexoid' => Yii::t('app', 'Anexoid'),
            'fecha' => Yii::t('app', 'Fecha'),
            'anexo' => Yii::t('app', 'Anexo'),
            'idtabla' => Yii::t('app', 'Idtabla'),
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnexo0()
    {
        return $this->hasOne(Anexo::className(), ['id' => 'anexoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCumplimiento()
    {
        return $this->hasOne(Cumplimiento::className(), ['id' => 'cumplimientoid']);
    }
}
