<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class putMethodAction extends AppAction
{
    public function __invoke($id)
    {
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = $pagesTable->newEntity(
            [
                'id' => $id,
                'title' => $this->getRequest()->getPut('title'),
                'body' => $this->getRequest()->getPut('body'),
            ]
        );

        $pagesTable->save($page);

        $page = $pagesTable->find()
            ->where(['id' => $id])
            ->first();
        $this->getResponder()->setData('page', $page);
    }
}
