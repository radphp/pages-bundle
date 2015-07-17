<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class DeleteMethodAction extends AppAction
{
    public function __invoke($id)
    {
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $pagesTable->deleteAll(['id' => $id]);
    }
}
