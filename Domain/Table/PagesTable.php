<?php
namespace Pages\Domain\Table;

use Cake\ORM\Table;

/**
 * Pages Table
 *
 * @package Pages\Domain\Table
 */
class PagesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always'
                ]
            ]
        ]);
    }
}
