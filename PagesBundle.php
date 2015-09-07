<?php

namespace Pages;

use Admin\Library\Menu;
use Rad\Core\AbstractBundle;

/**
 * Pages Bundle
 *
 * @package Pages
 */
class PagesBundle extends AbstractBundle
{
    /**
     * {@inheritdoc}
     */
    public function startup()
    {
        $this->getEventManager()->attach(Menu::EVENT_GET_MENU, [$this, 'addAdminMenu']);
    }

    /**
     * Add required menu for admin panel
     */
    public function addAdminMenu()
    {
        $parent = Menu::addMenu('Pages', 'fa-file-text');
        Menu::addMenu('Pages', '', '/admin/bundles/pages', 100, $parent);
        Menu::addMenu('Add Page', '', '/admin/bundles/pages/new', 110, $parent);
    }
}
