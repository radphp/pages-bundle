<?php

namespace Pages\Responder;
use App\Responder\AppResponder;

/**
 * Index Responder
 *
 * @package Pages\Responder
 */
class deleteMethodResponder extends AppResponder
{
    public function __invoke()
    {
        $this->setRawContent('OK');
    }
}
