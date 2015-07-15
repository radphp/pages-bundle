<?php

namespace Pages\Responder;
use App\Responder\AppResponder;

/**
 * Index Responder
 *
 * @package Pages\Responder
 */
class IndexResponder extends AppResponder
{
    public function getMethod()
    {
        $template = '';
        $params = [];

        if ($pages = $this->getData('pages', [])) {
            $params = ['pages' => $pages];
            $template = '@Pages/index.twig';
        } elseif ($page = $this->getData('page', [])) {
            $params = ['page' => $page];
            $template = '@Pages/pages.twig';
        }

        $this->setContent($template, $params);
    }

    public function postMethod()
    {
        $this->setRawContent('OK');
    }

    public function putMethod()
    {
        $this->getMethod();
    }

    public function deleteMethod()
    {
        $this->postMethod();
    }
}
