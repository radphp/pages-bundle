<?php

namespace Pages\Action;

use App\Action\AppAction;
use Pages\Library\AuthorizationTrait;
use Pages\Library\Form;

class NewAction extends AppAction
{
    use AuthorizationTrait;

    public $needsAuthentication = true;

    public function getMethod()
    {
        $this->getResponder()->setData('form', Form::getForm());
    }
}
