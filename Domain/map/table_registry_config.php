<?php

Cake\ORM\TableRegistry::config(
    'Pages.Pages',
    [
        'table' => 'pages',
        'alias' => 'Pages',
        'className' => 'Pages\Domain\Table\PagesTable',
        'entityClass' => 'Pages\Domain\Entity\Page',
    ]
);