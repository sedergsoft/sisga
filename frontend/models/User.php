<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $trabajadorid
 * @property int $direccionid
 * @property int $rolid
 * @property string $auth_key
 * @property int $conectado
 * @property int $status

 * @property int $created_at
 * @property int $updated_at
 * @property string $password write-only password
 *
 * @property Cumplimiento[] $cumplimientos
 * @property Evaluacion[] $evaluacions
 * @property Trabajador[] $trabajadors
 * @property Trazas[] $trazas
 * @property Direccion $direccion
 * @property Rol $rol
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'password_reset_token', 'trabajadorid'], 'required'],
            [['trabajadorid','conectado' ,'direccionid', 'rolid', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'auth_key', 'password write-only password'], 'string', 'max' => 255],
            [['direccionid'], 'exist', 'skipOnError' => true, 'targetClass' => Direccion::className(), 'targetAttribute' => ['direccionid' => 'id']],
            [['rolid'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rolid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'trabajadorid' => Yii::t('app', 'Trabajadorid'),
            'direccionid' => Yii::t('app', 'Direccionid'),
            'rolid' => Yii::t('app', 'Rolid'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'password write-only password' => Yii::t('app', 'Password Write Only Password'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCumplimientos()
    {
        return $this->hasMany(Cumplimiento::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacions()
    {
        return $this->hasMany(Evaluacion::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajadors()
    {
        return $this->hasMany(Trabajador::className(), ['iduser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrazas()
    {
        return $this->hasMany(Trazas::className(), ['IdUsuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireccion()
    {
        return $this->hasOne(Direccion::className(), ['id' => 'direccionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rolid']);
    }
}
