<?php
class WebUser extends CWebUser
{
    public function getRole()
    {
        return $this->getState('role'); 
    }
}
