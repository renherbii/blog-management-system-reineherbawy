<?php
class RegisterForm extends CFormModel
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return array(
            array('username, email, password, password_repeat', 'required'),
            array('username', 'length', 'min'=>3, 'max'=>50),
            array('email', 'email'),
            array('password', 'length', 'min'=>6, 'max'=>255),
            array('password_repeat', 'compare', 'compareAttribute'=>'password'),
            array('username, email', 'filter', 'filter'=>'trim'),
            array('username', 'unique', 'className'=>'User', 'attributeName'=>'username', 'message'=>'Username already taken.'),
            array('email', 'unique', 'className'=>'User', 'attributeName'=>'email', 'message'=>'Email already registered.'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'password_repeat' => 'Confirm Password',
        );
    }

    public function register()
    {
        if (!$this->validate()) return false;

        $user = new User();
        $user->username = $this->username;
        $user->email    = $this->email;
        // Hash password
        if (class_exists('CPasswordHelper')) {
            $user->password = CPasswordHelper::hashPassword($this->password);
        } else {
            $user->password = password_hash($this->password, PASSWORD_DEFAULT);
        }
        // SECURITY: self-registrations become editors by default
        $user->role = 'editor';

        return $user->save();
    }
}
