<?php

Cake\ORM\TableRegistry::config(
    'Pages.Categories',
    [
        'table' => 'pages',
        'alias' => 'Pages',
        'className' => 'Pages\Domain\Table\PagesTable',
        'entityClass' => 'Pages\Domain\Entity\Page',
    ]
);