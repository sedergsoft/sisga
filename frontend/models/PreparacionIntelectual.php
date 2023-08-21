<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "preparacion_intelectual".
 *
 * @property int $id
 * @property int $nivel_escolaridad                                        
 * @property string $Especialidad
 * @property int $grado_cientifico
 * @property int $categoria_docente
 * @property int $informatica
 *
 * @property Cuadro[] $cuadros
 * @property CategoriaDocente $categoriaDocente
 * @property NivelEscolaridad $nivelEscolaridad
 * @property GradoCientifico $gradoCientifico
 * @property PreparacionIntelectualIdiomas[] $preparacionIntelectualIdiomas
 * @property Idiomas[] $idiomas
 */
class PreparacionIntelectual extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preparacion_intelectual';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nivel_escolaridad'], 'required'],
            [['nivel_escolaridad', 'grado_cientifico', 'categoria_docente', 'informatica'], 'integer'],
            [['Especialidad'], 'string', 'max' => 255],
            [['categoria_docente'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriaDocente::className(), 'targetAttribute' => ['categoria_docente' => 'id']],
            [['nivel_escolaridad'], 'exist', 'skipOnError' => true, 'targetClass' => NivelEscolaridad::className(), 'targetAttribute' => ['nivel_escolaridad' => 'id']],
            [['grado_cientifico'], 'exist', 'skipOnError' => true, 'targetClass' => GradoCientifico::className(), 'targetAttribute' => ['grado_cientifico' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nivel_escolaridad' => Yii::t('app', 'Nivel Escolaridad'),
            'Especialidad' => Yii::t('app', 'Especialidad'),
            'grado_cientifico' => Yii::t('app', 'Grado Cientifico'),
            'categoria_docente' => Yii::t('app', 'Categoria Docente'),
            'informatica' => Yii::t('app', 'Informatica'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['preparacion_intelectualid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaDocente()
    {
        return $this->hasOne(CategoriaDocente::className(), ['id' => 'categoria_docente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelEscolaridad()
    {
        return $this->hasOne(NivelEscolaridad::className(), ['id' => 'nivel_escolaridad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGradoCientifico()
    {
        return $this->hasOne(GradoCientifico::className(), ['id' => 'grado_cientifico']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparacionIntelectualIdiomas()
    {
        return $this->hasMany(PreparacionIntelectualIdiomas::className(), ['preparacion_intelectualid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdiomas()
    {
        return $this->hasMany(Idiomas::className(), ['id' => 'idiomasid'])->viaTable('preparacion_intelectual_idiomas', ['preparacion_intelectualid' => 'id']);
    }
}
