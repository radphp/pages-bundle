<?php

namespace Pages\Action;

use App\Action\AppAction;
use Symfony\Component\Form\Forms;

class CreateAction extends AppAction
{
    public function getMethod()
    {
        $formFactory = Forms::createFormFactory();
        $options = [
            'action' => $this->getRouter()->generateUrl(['pages']),
            'method' => 'POST'
        ];

        $form = $formFactory->createBuilder('form', null, $options)
            ->add('task', 'text', ['required' => true])
            ->add('dueDate', 'date', ['required' => true])
            ->add('submit', 'submit')
            ->getForm();

        $this->getResponder()->setData('form', $form);
    }
}