<?php

namespace Pages\Responder;
use App\Responder\AppResponder;

/**
 * Create Responder
 *
 * @package Pages\Responder
 */
class CreateResponder extends AppResponder
{
    public function getMethod()
    {
        $form = $this->getData('form');

        $this->setContent(
            '@App/simpleform.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
