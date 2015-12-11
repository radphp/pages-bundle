<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use DataTable\Column;
use DataTable\DataSource\ServerSide\CakePHP;
use DataTable\Table;
use Pages\Event\Pages;
use Pages\Library\AuthorizationTrait;
use Pages\Library\Form;
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
        $this->getEventManager()->dispatch(Pages::EVENT_BEFORE_GET_ACTION, $this);

        switch ($action) {
            case 'edit':
                $this->edit($slug);
                break;
            default:
                if ($slug) {
                    $this->singleBusiness($slug);
                } else {
                    $this->generateDatatable();
                }
        }

        $this->getEventManager()->dispatch(Pages::EVENT_AFTER_GET_ACTION, $this);
    }

    private function edit($slug)
    {
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = $pagesTable->find()
            ->where(['slug' => $slug])
            ->first();

        $this->getResponder()->setData('form', Form::getForm($page));
    }

    private function generateDatatable()
    {
        TwigHelper::addCss('file:///Admin/vendor/datatables/media/css/jquery.dataTables.min.css', 100);
        TwigHelper::addJs('file:///Admin/vendor/jquery/dist/jquery.min.js', 20);
        TwigHelper::addJs('file:///Admin/vendor/datatables/media/js/jquery.dataTables.min.js', 100);
        TwigHelper::addJs('
        function deletePage(id) {
    if (confirm(\'Delete this user?\')) {
        $.ajax({
            type: "DELETE",
            url: \'pages/\' + id,
            success: function(affectedRows) {
                if (affectedRows > 0) window.location = \'pages\';
            }
        });
    }
}', 110);

        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');
        $pages = $pagesTable->find();

        $table = new Table();

        $col = new Column();
        $col->setTitle('Title')
            ->setData('Pages.title');
        $table->addColumn($col);

        $col = new Column();
        $col->setTitle('Slug')
            ->setData('Pages.slug');
        $table->addColumn($col);

        $router = $this->getRouter();

        $col = new Column\Action();
        $col->setManager(
            function (Column\ActionBuilder $action, Entity $page) use ($router) {
                if (/* hasAdminAcl */ true) {
                    $action->addAction(
                        'edit',
                        'Edit',
                        $router->generateUrl(['pages', $page->get('slug'), 'edit'])
                    );

                    $action->addAction(
                        'delete',
                        'Delete',
                        'javascript:deletePage("' . $page->get('slug') . '");'
                    );
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
    }


    private function singleBusiness($slug)
    {
        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = $pagesTable->find()
            ->where(['slug' => $slug])
            ->first();

        $this->getResponder()->setData('page', $page);
    }
}
