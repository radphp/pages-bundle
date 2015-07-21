<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class PutMethodAction extends AppAction
{
    public function __invoke($id)
    {
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = $pagesTable->newEntity(
            [
                'id' => $id,
                'title' => $this->getRequest()->getParsedBody()['title'],
                'body' => $this->getRequest()->getParsedBody()['body'],
            ]
        );

        $pagesTable->save($page);

        $page = $pagesTable->find()
            ->where(['id' => $id])
            ->first();
        $this->getResponder()->setData('page', $page);
    }
}
