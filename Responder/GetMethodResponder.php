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
        // if it is edit form
        if ($form = $this->getData('form', false)) {
            return $this->render(
                '@App/simpleform.twig',
                [
                    'form' => $form->createView(),
                    'title' => 'Edit a page',
                ]
            );
        }

        if ($page = $this->getData('page', [])) {
            $params = ['page' => $page];
            $template = '@Pages/pages.twig';
        } else {
            $params = ['table' => $this->getData('table', '')];
            $template = '@Pages/index.twig';
        }

        return $this->render($template, $params);
    }
}
