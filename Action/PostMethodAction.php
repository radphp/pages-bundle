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
class PostMethodAction extends AppAction
{
    public function __invoke()
    {
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $formValues = $this->getRequest()->getParsedBody()['form'];
        $page = $pagesTable->newEntity(
            [
                'slug' => $formValues['slug'],
                'title' => $formValues['title'],
                'body' => $formValues['body'],
            ]
        );

        $pagesTable->save($page);

        // redirect to last page
        return (new Response())->redirect($this->getRouter()->generateUrl(['pages']));
    }
}
