<?php

namespace Pages\Responder;
use App\Responder\AppResponder;

/**
 * Index Responder
 *
 * @package Pages\Responder
 */
class GetMethodResponder extends AppResponder
{
    public function __invoke()
    {
        if ($page = $this->getData('page', [])) {
            $params = ['page' => $page];
            $template = '@Pages/pages.twig';
        } else {
            $params = ['table' => $this->getData('table', '')];
            $template = '@Pages/index.twig';
        }

        $this->setContent($template, $params);
    }
}
