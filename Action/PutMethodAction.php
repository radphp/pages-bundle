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
class PutMethodAction extends AppAction
{
    public function __invoke($id)
    {
        $formValues = $this->getRequest()->getParsedBody()['form'];
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = $pagesTable->newEntity(
            [
                'id' => $id,
                'title' => $formValues['title'],
                'body' => $formValues['body'],
            ]
        );

        $pagesTable->save($page);

        // redirect to last page
        return (new Response())->redirect($this->getRouter()->generateUrl(['pages']));
    }
}
