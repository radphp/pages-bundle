<?php

namespace Pages;

use Rad\Core\Bundle;
use Twig\Library\Helper as TwigHelper;

/**
 * Pages Bootstrap
 *
 * @package Pages
 */
class Bootstrap extends Bundle
{
    public function startup()
    {
        TwigHelper::addCss('file:////netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css');
        TwigHelper::addCss('file:////netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css');
        TwigHelper::addCss('file:///Pages/css/Pages.css', 10);

        TwigHelper::addJs('file:////ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js');
        TwigHelper::addJs('file:////ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-resource.min.js');
        TwigHelper::addJs('file:////ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-route.min.js');
        TwigHelper::addJs('file:///Pages/js/angular/Pages.js', 10);
        TwigHelper::addJs('file:///Pages/js/angular/PagesController.js', 20);

        TwigHelper::addMasterTwig('@App/master.twig');
    }
}
