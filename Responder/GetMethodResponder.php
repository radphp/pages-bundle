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
        if ($this->getRequest()->isAjax()) {
            $params = ['page' => $this->getData('page', [])];
            $template = '@Pages/pages.twig';
        } else {
            $params = ['pages' => $this->getData('pages', []), 'page' => $this->getData('page')];
            if ($this->getRequest()->getQuery('inline')){
                $template = '@Pages/inline.twig';
            } else {
                $template = '@Pages/index.twig';
            }
        }

        $this->setContent($template, $params);
    }
}
