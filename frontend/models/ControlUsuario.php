<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "control_usuario".
 *
 * @property int $id
 * @property int $userid
 * @property string $preg_1
 * @property string $preg_2
 * @property string $preg_3
 * @property string $preg_4
 * @property string $preg_5
 * @property string $resp_1
 * @property string $resp_2
 * @property string $resp_3
 * @property string $resp_4
 * @property string $resp_5
 */
class ControlUsuario extends \yii\db\ActiveRecord
{
    public $user;
    public $resp1_user;
    public $resp2_user;
    public $resp3_user;
    public $resp4_user;
    public $resp5_user;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'preg_1', 'preg_2', 'preg_3', 'preg_4', 'preg_5', 'resp_1', 'resp_2', 'resp_3', 'resp_4', 'resp_5'], 'required'],
            [['userid'], 'integer'],
            [['preg_1', 'preg_2', 'preg_3', 'preg_4', 'preg_5', 'resp_1', 'resp_2', 'resp_3', 'resp_4', 'resp_5','user','resp1_user','resp2_user','resp3_user','resp4_user','resp5_user'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userid' => Yii::t('app', 'Usuario'),
            'preg_1' => Yii::t('app', 'Pregunta 1'),
            'preg_2' => Yii::t('app', 'Pregunta 2'),
            'preg_3' => Yii::t('app', 'Pregunta 3'),
            'preg_4' => Yii::t('app', 'Pregunta 4'),
            'preg_5' => Yii::t('app', 'Pregunta 5'),
            'resp_1' => Yii::t('app', 'Respueta 1'),
            'resp_2' => Yii::t('app', 'Respueta 2'),
            'resp_3' => Yii::t('app', 'Respueta 3'),
            'resp_4' => Yii::t('app', 'Respueta 4'),
            'resp_5' => Yii::t('app', 'Respueta 5'),
            'resp1_user' => Yii::t('app', 'Respueta 1'),
            'resp2_user' => Yii::t('app', 'Respueta 2'),
            'resp3_user' => Yii::t('app', 'Respueta 3'),
            'resp4_user' => Yii::t('app', 'Respueta 4'),
            'resp5_user' => Yii::t('app', 'Respueta 5'),
          
            'user' => Yii::t('app', 'Usuario'),
        ];
    }
}
