<?php

namespace Pages\Responder;
use App\Responder\AppResponder;
use Pages\Event\Pages;

/**
 * Index Responder
 *
 * @package Pages\Responder
 */
class GetMethodResponder extends AppResponder
{
    public $return;

    public function __invoke()
    {
        $this->getEventManager()->dispatch(Pages::EVENT_BEFORE_RESPONDER, $this);

        // return if before event has a result
        if ($this->return) {
            return $this->return;
        }

        // if it is edit form
        if ($form = $this->getData('form', false)) {
            $this->return = $this->render(
                '@App/simpleform.twig',
                [
                    'form' => $form->createView(),
                    'title' => 'Edit a page',
                ]
            );
        } else {
            if ($page = $this->getData('page', [])) {
                $params = ['page' => $page];
                $template = '@Pages/pages.twig';
            } else {
                $params = ['table' => $this->getData('table', '')];
                $template = '@Pages/index.twig';
            }

            $this->return = $this->render($template, $params);
        }

        $this->getEventManager()->dispatch(Pages::EVENT_AFTER_RESPONDER, $this);

        return $this->return;
    }
}
