
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HeaderBlockWidget extends CWidget
{
    public function init()
    {
        // этот метод будет вызван внутри CBaseController::beginWidget()
    }
 
    public function run()
    {
        $this->render('headerBlockWidget');
        // этот метод будет вызван внутри CBaseController::endWidget()
    }
}