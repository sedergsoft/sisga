<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cuadro".
 *
 * @property int $id
 * @property string $personaCI
 * @property int $Lugar_nacimiento
 * @property int $provinciaid
 * @property string $ciudadania
 * @property string $color_piel
 * @property string $color_ojos
 * @property string $color_pelo
 * @property double $estatura
 * @property double $peso
 * @property string $telefono
 * @property string $email
 * @property int $preparacion_intelectualid
 * @property int $centro_trabajoid
 * @property int $cargoid
 * @property string $fecha_inicio_cargo
 * @property int $trayectoria_militarid
 * @property string $ubicacion_tiempo_guerra
 * @property string $foto
 * @property int $vehiculo
 * @property int $arma
 * @property int $ingresos_monetarios
 * @property int $beneficio_ingreso
 * @property int $reserva_cuadro
 * @property int $saludid
 * @property int $status
 * 
 *
 * @property Armas[] $armas
 * @property BeneficioIngresos[] $beneficioIngresos
 * @property Condecoraciones[] $condecoraciones
 * @property Cargo $cargo
 * @property CentroTrabajo $centroTrabajo
 * @property Salud $salud
 * @property PreparacionIntelectual $preparacionIntelectual
 * @property TrayectoriaMilitar $trayectoriaMilitar
 * @property Persona $personaCI0
 * @property Provincia $provincia
 * @property Municipio $lugarNacimiento
 * @property CuadroEscuelaPolitica[] $cuadroEscuelaPoliticas
 * @property CuadroEstudiosActuales[] $cuadroEstudiosActuales
 * @property EstudiosActuales[] $estudiosActuales
 * @property CuadroFamiliar[] $cuadroFamiliars
 * @property Familiar[] $familiars
 * @property CuadroIngresosMonetarios[] $cuadroIngresosMonetarios
 * @property CuadroSanciones[] $cuadroSanciones
 * @property Sanciones[] $sanciones
 * @property Directivo[] $directivos
 * @property EstanciaExterior[] $estanciaExteriors
 * @property LugaresResidencia[] $lugaresResidencias
 * @property MovimientoCuadro[] $movimientoCuadros
 * @property MovimientoCuadro[] $movimientoCuadros0
 * @property RelacionesExterior[] $relacionesExteriors
 * @property TrayectoriaEstudiantil[] $trayectoriaEstudiantils
 * @property TrayectoriaLaboral[] $trayectoriaLaborals
 * @property Vehiculo[] $vehiculos
 */
class Cuadro extends \yii\db\ActiveRecord
{
   
      public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuadro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['personaCI', 'Lugar_nacimiento', 'ciudadania', 'color_piel', 'color_ojos', 'color_pelo', 'estatura', 'peso', 'preparacion_intelectualid', 'centro_trabajoid', 'cargoid', 'fecha_inicio_cargo',  'ubicacion_tiempo_guerra', 'foto', 'saludid'], 'required'],
            [['Lugar_nacimiento', 'provinciaid', 'preparacion_intelectualid', 'centro_trabajoid', 'cargoid', 'trayectoria_militarid', 'vehiculo', 'arma', 'ingresos_monetarios', 'beneficio_ingreso', 'trayectoria_militarid','reserva_cuadro', 'saludid'], 'integer'],
            [['estatura', 'peso'], 'number'],
            [['fecha_inicio_cargo'], 'safe'],
            [['personaCI'], 'string', 'min'=>11,'max' => 11,],
            ['personaCI', 'ValidarCI'],
            [['telefono',], 'string', 'min'=>6,'max' => 12],
            [['ciudadania', 'color_piel', 'color_ojos', 'color_pelo',  'email', 'ubicacion_tiempo_guerra', 'foto'], 'string', 'max' => 255],
            [['cargoid'], 'exist', 'skipOnError' => true, 'targetClass' => Cargo::className(), 'targetAttribute' => ['cargoid' => 'id']],
            [['centro_trabajoid'], 'exist', 'skipOnError' => true, 'targetClass' => CentroTrabajo::className(), 'targetAttribute' => ['centro_trabajoid' => 'id']],
            [['saludid'], 'exist', 'skipOnError' => true, 'targetClass' => Salud::className(), 'targetAttribute' => ['saludid' => 'id']],
            [['preparacion_intelectualid'], 'exist', 'skipOnError' => true, 'targetClass' => PreparacionIntelectual::className(), 'targetAttribute' => ['preparacion_intelectualid' => 'id']],
            [['trayectoria_militarid'], 'exist', 'skipOnError' => true, 'targetClass' => TrayectoriaMilitar::className(), 'targetAttribute' => ['trayectoria_militarid' => 'id']],
            [['personaCI'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['personaCI' => 'CI']],
            [['provinciaid'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provinciaid' => 'id']],
            [['Lugar_nacimiento'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['Lugar_nacimiento' => 'id']],
            [['file'],'safe'],
          //  [['file'],'file','extensions'=>'jpg, gif, png'],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'personaCI' => Yii::t('app', 'NI'),
            'Lugar_nacimiento' => Yii::t('app', 'Lugar Nacimiento'),
            'provinciaid' => Yii::t('app', 'Provincia'),
            'ciudadania' => Yii::t('app', 'Ciudadania'),
            'color_piel' => Yii::t('app', 'Color Piel'),
            'color_ojos' => Yii::t('app', 'Color Ojos'),
            'color_pelo' => Yii::t('app', 'Color Pelo'),
            'estatura' => Yii::t('app', 'Estatura'),
            'peso' => Yii::t('app', 'Peso'),
            'telefono' => Yii::t('app', 'Telefono'),
            'email' => Yii::t('app', 'Email'),
            'preparacion_intelectualid' => Yii::t('app', 'Preparación Intelectual'),
            'centro_trabajoid' => Yii::t('app', 'Centro Trabajo'),
            'cargoid' => Yii::t('app', 'Cargoid'),
            'fecha_inicio_cargo' => Yii::t('app', 'Fecha de Inicio en el Cargo'),
            'trayectoria_militarid' => Yii::t('app', 'Trayectoria Militar'),
            'ubicacion_tiempo_guerra' => Yii::t('app', 'Ubicación Tiempo Guerra'),
            'foto' => Yii::t('app', 'Foto'),
            'vehiculo' => Yii::t('app', 'Vehiculo'),
            'arma' => Yii::t('app', 'Arma'),
            'ingresos_monetarios' => Yii::t('app', 'Ingresos Monetarios'),
            'beneficio_ingreso' => Yii::t('app', 'Beneficio Ingreso'),
            'reserva_cuadro' => Yii::t('app', 'Reserva Cuadro'),
            'saludid' => Yii::t('app', 'Salud'),
            'file' => Yii::t('app', 'foto'),
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArmas()
    {
        return $this->hasMany(Armas::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeneficioIngresos()
    {
        return $this->hasMany(BeneficioIngresos::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondecoraciones()
    {
        return $this->hasMany(Condecoraciones::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargo()
    {
        return $this->hasOne(Cargo::className(), ['id' => 'cargoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroTrabajo()
    {
        return $this->hasOne(CentroTrabajo::className(), ['id' => 'centro_trabajoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalud()
    {
        return $this->hasOne(Salud::className(), ['id' => 'saludid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparacionIntelectual()
    {
        return $this->hasOne(PreparacionIntelectual::className(), ['id' => 'preparacion_intelectualid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaMilitar()
    {
        return $this->hasOne(TrayectoriaMilitar::className(), ['id' => 'trayectoria_militarid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaCI0()
    {
        return $this->hasOne(Persona::className(), ['CI' => 'personaCI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['id' => 'provinciaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugarNacimiento()
    {
        return $this->hasOne(Municipio::className(), ['id' => 'Lugar_nacimiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroEscuelaPoliticas()
    {
        return $this->hasMany(CuadroEscuelaPolitica::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroEstudiosActuales()
    {
        return $this->hasMany(CuadroEstudiosActuales::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiosActuales()
    {
        return $this->hasMany(EstudiosActuales::className(), ['id' => 'estudios_actualesid'])->viaTable('cuadro_estudios_actuales', ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroFamiliars()
    {
        return $this->hasMany(CuadroFamiliar::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliars()
    {
        return $this->hasMany(Familiar::className(), ['id' => 'familiarid'])->viaTable('cuadro_familiar', ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroIngresosMonetarios()
    {
        return $this->hasMany(CuadroIngresosMonetarios::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroSanciones()
    {
        return $this->hasMany(CuadroSanciones::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSanciones()
    {
        return $this->hasMany(Sanciones::className(), ['id' => 'sancionesid'])->viaTable('cuadro_sanciones', ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirectivos()
    {
        return $this->hasMany(Directivo::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstanciaExteriors()
    {
        return $this->hasMany(EstanciaExterior::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugaresResidencias()
    {
        return $this->hasMany(LugaresResidencia::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoCuadros()
    {
        return $this->hasMany(MovimientoCuadro::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoCuadros0()
    {
        return $this->hasMany(MovimientoCuadro::className(), ['cuadro_sustituido' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacionesExteriors()
    {
        return $this->hasMany(RelacionesExterior::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaEstudiantils()
    {
        return $this->hasMany(TrayectoriaEstudiantil::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrayectoriaLaborals()
    {
        return $this->hasMany(TrayectoriaLaboral::className(), ['cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehiculos()
    {
        return $this->hasMany(Vehiculo::className(), ['cuadroid' => 'id']);
    }
    
     public function ValidarCI() 
    {
        $valido = FALSE;
        $ci = $this->personaCI;
      // $t = strlen(ci);        
     if(strlen($ci) == 11 )
     { 
       $mes = substr($ci,2,2);
       $dia = substr($ci,4,2);
       if($mes == 02)
       {
           if($dia < 29 && $dia > 00)
           {
             $valido = TRUE;  
           }
       }
       else{
           if($mes >00 && $mes < 13)
            {
               if($dia < 31 && $dia > 00)
                   $valido = TRUE;
            }
            else{
                $valido = FALSE;
            }
       }
                 
     }
    
     if($valido == FALSE)
     {
         $this->addError('personaCI', 'El Número de identidad no es valido, por favor verifiquelo');
     }
   }
}
