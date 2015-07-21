<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class PostMethodAction extends AppAction
{
    public function __invoke()
    {
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = $pagesTable->newEntity(
            [
                'slug' => $this->getRequest()->getParsedBody()['slug'],
                'title' => $this->getRequest()->getParsedBody()['title'],
                'body' => $this->getRequest()->getParsedBody()['body'],
            ]
        );

        $pagesTable->save($page);
    }
}
