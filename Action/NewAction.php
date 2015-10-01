<?php

namespace Pages\Action;

use App\Action\AppAction;
use Pages\Library\Form;

class NewAction extends AppAction
{
    public $needsAuthentication = true;

    public function getMethod()
    {
        $this->getResponder()->setData('form', Form::getForm());
    }
}
