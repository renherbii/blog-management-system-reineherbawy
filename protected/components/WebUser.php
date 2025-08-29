<?php
class WebUser extends CWebUser
{
    public function getRole()
    {
        return $this->getState('role'); 
    }
    public function getId()
{
    return $this->getState('id');
}

}
