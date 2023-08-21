<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;
use frontend\controllers\UserController;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {if ($this->validate()) 
            {
                if(!UserController::IsConnected($this->username))
                   {
                      /*  if($this->_user->rolid == 1)
                            {
                            return $this->getRedirect();
                            }
*/
                    return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
                    } 
                    else{
                          $message = "Este usuario ya se encuentra conectado, si es usted el creador de este usuario contacte con la administracion del local, es posible que otra persona este usando sus credenciales...";
                          $name = "Usuario Conectado";
                          Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createUrl(['site/errores', 'message' => $message, 'name'=>$name]));
                                  
                          return FALSE;
                          }
                    
            }
            else {
                    return false;
                  }
}

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
