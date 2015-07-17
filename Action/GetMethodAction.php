<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class GetMethodAction extends AppAction
{
    public function __invoke($slug = '')
    {
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        if ($this->getRequest()->isAjax()) {
            if ($slug) {
                $page = $pagesTable->find()
                    ->where(['slug' => $slug])
                    ->first();
                $this->getResponder()->setData('page', $page);

                return;
            }
        }

        $pages = $pagesTable->find();
        $this->getResponder()->setData('pages', $pages);
        $this->getResponder()->setData('page', $slug);
    }
}
