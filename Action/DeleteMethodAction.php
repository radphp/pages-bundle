<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;
use Pages\Library\AuthorizationTrait;
use Rad\Network\Http\Response;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class DeleteMethodAction extends AppAction
{
    use AuthorizationTrait;

    public $needsAuthentication = true;

    public function __invoke($slug)
    {
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        return new Response($pagesTable->deleteAll(['slug' => $slug]));
    }
}
