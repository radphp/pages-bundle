<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use DataTable\Column;
use DataTable\DataSource\ServerSide\CakePHP;
use DataTable\Table;
use Rad\Routing\Router;
use Twig\Library\Helper as TwigHelper;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class GetMethodAction extends AppAction
{
    public function __invoke($slug = '', $action = '')
    {
        TwigHelper::addCss('file:///Admin/vendor/datatables/media/css/jquery.dataTables.min.css', 100);
        TwigHelper::addJs('file:///Admin/vendor/jquery/dist/jquery.min.js', 20);
        TwigHelper::addJs('file:///Admin/vendor/datatables/media/js/jquery.dataTables.min.js', 100);

        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = [];
        if ($slug) {
            $page = $pagesTable->find()
                ->where(['slug' => $slug])
                ->first();
        }

        $pages = $pagesTable->find();

        $table = new Table();
        $col = new Column();
        $col->setTitle('Slug')
            ->setData('Pages.slug');
        $table->addColumn($col);

        $col = new Column();
        $col->setTitle('Title')
            ->setData('Pages.title');
        $table->addColumn($col);

        $router = $this->getRouter();

        $col = new Column\Action();
        $col->setManager(
                function (Column\ActionBuilder $action, Entity $page) use ($router) {
                    if (/* hasAdminAcl */ true) {
                        $action->addAction(
                            'edit',
                            'Edit',
                            $router->generateUrl(['pages', $page->get('id'), 'edit'])
                        );

                        //$action->addAction(
                        //    'delete',
                        //    'Delete',
                        //    Router::url(['controller' => 'Repositories', 'action' => 'delete', $page->getId()]),
                        //    ['title' => 'Delete “{0}” key(s)', $page->getTitle(), 'rel' => 'permalink']
                        //);
                    }
                }
            )
            ->setTitle('Actions');
        $table->addColumn($col);

        $table->setDataSource(new CakePHP($pages, $this->getRequest()->getRequestTarget()));

        if ($this->getRequest()->isAjax()) {
            die($table->getResponse());
        }

        $this->getResponder()->setData('table', $table->render());
        $this->getResponder()->setData('pages', $pages);
        $this->getResponder()->setData('page', $page);

    }
}
