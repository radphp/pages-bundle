<?php

namespace Pages;

use Rad\Core\Bundle;

/**
 * Pages Bootstrap
 *
 * @package Pages
 */
class Bootstrap extends Bundle
{
    public function startup()
    {
        parent::startup();

        $this->getEventManager()->attach(Admin\Library\MenuLibrary::EVENT_GET_MENU, [$this, 'addAdminMenu']);
    }

    private function addAdminMenu()
    {
    }
}
