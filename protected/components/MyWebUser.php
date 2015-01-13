<?php

/**
 *
 * @author gnesenka
 */
class MyWebUser extends CWebUser
{

    public function __construct()
    {
        
    }

    private $_model = null;

    public function getUserLogout()
    {        
        if (Yii::app()->user->logoutDeleteUser()) {
            Yii::app()->user->logout();
            return true;
        }
    }

    public function getUserObj()
    {
        return $this->getState('__user_obj');
    }

    public function setUserObj($value)
    {
        $this->setState('__user_obj', $value);
    }

    public function refresh()
    {
        $user = User::model()->findByPk($this->getUserObj()->id);
        if ($user) {
            $this->setUserObj($user);
        }
    }

    function getRole()
    {
        if ($user = $this->getModel()) {

            return $user->role;
        }
    }

    private function getModel()
    {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }

}
