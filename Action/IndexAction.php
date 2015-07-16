<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;
use Rad\Events\Event;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class IndexAction extends AppAction
{
    /**
     * @var \Cake\ORM\Table $pagesTable
     */
    private $pagesTable;

    public function beforeWebMethod(Event $event)
    {
        $this->pagesTable = TableRegistry::get('Pages.Pages');

        parent::beforeWebMethod($event);
    }

    public function getMethod($slug = '')
    {
        if ($this->getRequest()->isAjax()) {
            if ($slug) {
                $page = $this->pagesTable->find()
                    ->where(['slug' => $slug])
                    ->first();
                $this->getResponder()->setData('page', $page);

                return;
            }
        }

        $pages = $this->pagesTable->find();
        $this->getResponder()->setData('pages', $pages);
    }

    public function postMethod()
    {
        $page = $this->pagesTable->newEntity(
            [
                'slug' => $this->getRequest()->getPost('slug'),
                'title' => $this->getRequest()->getPost('title'),
                'body' => $this->getRequest()->getPost('body'),
            ]
        );

        $this->pagesTable->save($page);
    }

    public function putMethod($id)
    {
        $page = $this->pagesTable->newEntity(
            [
                'id' => $id,
                'title' => $this->getRequest()->getPut('title'),
                'body' => $this->getRequest()->getPut('body'),
            ]
        );

        $this->pagesTable->save($page);

        $page = $this->pagesTable->find()
            ->where(['id' => $id])
            ->first();
        $this->getResponder()->setData('page', $page);
    }

    public function deleteMethod($id)
    {
        $this->pagesTable->deleteAll(['id' => $id]);
    }
}
