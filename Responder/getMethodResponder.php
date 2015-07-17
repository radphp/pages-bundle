<?php

namespace Pages\Responder;
use App\Responder\AppResponder;

/**
 * Index Responder
 *
 * @package Pages\Responder
 */
class getMethodResponder extends AppResponder
{
    public function __invoke()
    {
        $template = '';
        $params = [];

        if ($pages = $this->getData('pages', [])) {
            $params = ['pages' => $pages, 'page' => $this->getData('page')];
            $template = '@Pages/index.twig';
        } elseif ($page = $this->getData('page', [])) {
            $params = ['page' => $page];
            $template = '@Pages/pages.twig';
        }

        $this->setContent($template, $params);
    }
}
