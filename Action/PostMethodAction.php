<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;
use Rad\Network\Http\Response;
use Rad\Network\Http\Response\RedirectResponse;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class PostMethodAction extends AppAction
{
    public $needsAuthentication = true;

    /**
     * {@inheritdoc}
     *
     * @return RedirectResponse
     */
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
        return new RedirectResponse($this->getRouter()->generateUrl(['pages']));
    }
}
