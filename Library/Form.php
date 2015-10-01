<?php

namespace Pages\Library;

use Cake\ORM\Entity;
use Rad\DependencyInjection\Container;
use Rad\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Form\Forms;

class Form
{
    use ContainerAwareTrait;

    /**
     * @param Entity $page
     *
     * @return \Symfony\Component\Form\Form
     * @throws \Rad\DependencyInjection\Exception\ServiceNotFoundException
     */
    public static function getForm($page = null)
    {
        $data = null;
        if ($page) {
            $data = $page->toArray();
        }

        $action = $page ? Container::get('router')->generateUrl(['pages', $data['slug']]) :
            Container::get('router')->generateUrl(['pages']);

        $formFactory = Forms::createFormFactory();
        $options = [
            'action' => $action,
            'method' => $page ? 'PUT' : 'POST'
        ];

        return $formFactory->createBuilder('form', $data, $options)
            ->add('title', 'text', ['required' => true, 'attr' => ['class' => 'form-control']])
            ->add('slug', 'text', ['required' => true, 'attr' => ['class' => 'form-control']])
            ->add(
                'body',
                'textarea',
                [
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control wysiwyg'
                    ]
                ]
            )
            ->add('submit', 'submit')
            ->getForm();
    }
}
