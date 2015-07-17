<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class postMethodAction extends AppAction
{
    public function __invoke()
    {
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = $pagesTable->newEntity(
            [
                'slug' => $this->getRequest()->getPost('slug'),
                'title' => $this->getRequest()->getPost('title'),
                'body' => $this->getRequest()->getPost('body'),
            ]
        );

        $pagesTable->save($page);
    }
}
