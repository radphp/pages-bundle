<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;
use Pages\Library\AuthorizationTrait;
use Rad\Network\Http\Response;
use Rad\Network\Http\Response\RedirectResponse;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class PutMethodAction extends AppAction
{
    use AuthorizationTrait;

    public $needsAuthentication = true;

    public function __invoke($slug)
    {
        $formValues = $this->getRequest()->getParsedBody()['form'];
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = $pagesTable->find()
            ->where(['slug' => $slug])
            ->first();

        $id = $page['id'];

        $page = $pagesTable->newEntity(
            [
                'id' => $id,
                'title' => $formValues['title'],
                'body' => $formValues['body'],
            ]
        );

        $pagesTable->save($page);

        // redirect to last page
        return new RedirectResponse($this->getRouter()->generateUrl(['pages']));
    }
}
