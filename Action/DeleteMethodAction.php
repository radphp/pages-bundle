<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;
use Rad\Network\Http\Response;

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

        return new Response($pagesTable->deleteAll(['id' => $id]));
    }
}
