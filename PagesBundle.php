<?php

namespace Pages;

use Rad\Core\AbstractBundle;
use Rad\Stuff\Admin\Menu;

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
        $menuItem1 = (new Menu())
            ->setLabel('Pages')
            ->setLink('/admin/bundles/pages')
            ->setOrder(100);

        $menuItem2 = (new Menu())
            ->setLabel('Add Page')
            ->setLink('/admin/bundles/pages/new')
            ->setOrder(110);

        $root = new Menu();
        $root->setLabel('Pages')
            ->setIcon('fa-file-text')
            ->setOrder(50)
            ->addChild($menuItem1)
            ->addChild($menuItem2)
            ->setAsRoot();
    }
}
