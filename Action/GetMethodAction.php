<?php

namespace Pages\Action;

use App\Action\AppAction;
use Cake\ORM\TableRegistry;
use Rad\Routing\Router;
use Twig\Library\Helper as TwigHelper;

/**
 * Index Action
 *
 * @package Pages\Action
 */
class GetMethodAction extends AppAction
{
    public function __invoke($slug = '')
    {
        TwigHelper::addCss('file:////netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css');
        TwigHelper::addCss('file:////netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css');
        TwigHelper::addCss('file:///Pages/css/Pages.css', 10);

        TwigHelper::addJs('file:////ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js', -1000);
        TwigHelper::addJs('file:////ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-resource.min.js');
        TwigHelper::addJs('file:////ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-route.min.js');
        TwigHelper::addJs('file:///Pages/js/angular/Pages.js', 10);
        TwigHelper::addJs('file:///Pages/js/angular/PagesController.js', 20);

        TwigHelper::addMasterTwig('@App/master.twig');

        /** @var \Cake\ORM\Table $pagesTable */
        $pagesTable = TableRegistry::get('Pages.Pages');

        $page = [];
        if ($this->getRequest()->isAjax()) {
            if ($slug) {
                $page = $pagesTable->find()
                    ->where(['slug' => $slug])
                    ->first();
            }
        }

        $pages = $pagesTable->find();
        $this->getResponder()->setData('pages', $pages);
        $this->getResponder()->setData('page', $page);

        TwigHelper::addJs('angular
            .module("Pages", [])
            .value("URL", "' . $this->getRouter()->generateUrl(['pages'], [Router::GEN_OPT_WITH_PARAMS => false]) . '")
            .value("page", "' . $page['slug'] . '");', 5);
    }
}
