<?php

/**
 * Description of ReservationForm
 *
 * @author gnesenka
 */
class ReservationForm extends CFormModel
{

    public $email;
    public $name;
    public $phone;
    public $displacement;
    public $reserv;

    public function rules()
    {
        return array(
            array('email', 'required', 'message' => 'Вы не указали электронную почту'),
            array('email', 'email'),
            array('name', 'required', 'message' => 'Вы не указали имя'),
            array('phone', 'required', 'message' => 'Вы не указали телефон'),
            array('displacement', 'required', 'message' => 'Вы не указали oбъем двигателя'),
            array('reserv', 'required', 'message' => 'Вы не выбрали вид работ'),
        );
    }

}
