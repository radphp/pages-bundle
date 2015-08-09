<?php

namespace Pages\Responder;
use App\Responder\AppResponder;

/**
 * Create Responder
 *
 * @package Pages\Responder
 */
class NewResponder extends AppResponder
{
    public function getMethod()
    {
        $form = $this->getData('form');

        return $this->render(
            '@App/simpleform.twig',
            [
                'form' => $form->createView(),
                'title' => 'Add a new page',
            ]
        );
    }
}
