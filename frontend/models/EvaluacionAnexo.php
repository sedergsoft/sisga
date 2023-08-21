<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "evaluacion_anexo".
 *
 * @property int $evaluacionid
 * @property int $anexoid
 * @property string $nombre
 * @property string $fecha
 * @property string $anexo
 * @property int $idtabla
 * @property int $id
 * @property int $status
 *
 * @property Anexo $anexo0
 * @property Evaluacion $evaluacion
 */
class EvaluacionAnexo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
     public $file;
    
    public static function tableName()
    {
        return 'evaluacion_anexo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['evaluacionid', 'anexoid', 'anexo', 'idtabla'], 'required'],
            [['evaluacionid', 'anexoid', 'idtabla'], 'integer'],
            [['file'],'safe'],
           // [['file'],'file','extensions'=>'docx'],
            [['fecha'], 'safe'],
            [['anexo','nombre'], 'string', 'max' => 500],
           // [['anexoid'], 'exist', 'skipOnError' => true, 'targetClass' => Anexo::className(), 'targetAttribute' => ['anexoid' => 'id']],
            //[['evaluacionid'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluacion::className(), 'targetAttribute' => ['evaluacionid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'evaluacionid' => Yii::t('app', 'Evaluacionid'),
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
    public function getEvaluacion()
    {
        return $this->hasOne(Evaluacion::className(), ['id' => 'evaluacionid']);
    }
}
