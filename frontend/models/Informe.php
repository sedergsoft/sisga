<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class Informe extends Model

{
    public $mes;
    public $anno;
    public $tipo;
    public $organizacion;
    
  public function attributeLabels()
{
    return [
        'mes' => Yii::t('app', 'mes del Informe'),
        'anno' => Yii::t('app', 'año del Informe '),
        'tipo' => Yii::t('app', 'Tipo de Informe'),
        'organizacion' => Yii::t('app', 'Organizacion'),
    ];
}

public function rules()
{
    return [
        // username, email and password are all required in "register" scenario
        [['tipo'], 'required','message' => 'Debe selecionar un tipo de Informe.'],
        [['anno'], 'required','message' => 'Debe selecionar un año de generación.'],
        [['mes'], 'required','message' => 'Debe selecionar el mes de generación del Informe.'],
        [['organizacion'], 'required','message' => 'Debe selecionar la organizacion que desea que tenga el Informe.'],

    ];
}
    
}

