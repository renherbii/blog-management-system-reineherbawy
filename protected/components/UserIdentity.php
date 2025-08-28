<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	   private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
    {
        $user = User::model()->find('username=:u', array(':u'=>$this->username));

        if (!$user) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return !$this->errorCode;
        }

        if (class_exists('CPasswordHelper')) {
            $valid = CPasswordHelper::verifyPassword($this->password, $user->password);
        } else {
            $valid = password_verify($this->password, $user->password);
        }

        if (!$valid) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return !$this->errorCode;
        }

        $this->_id = (int)$user->id;
        $this->setState('role', $user->role); 
        $this->setState('username', $user->username);

        $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}