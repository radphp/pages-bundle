<?php

use Phinx\Migration\AbstractMigration;

/**
 * Initial Pages
 */
class InitialPages extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $this->execute(
            'CREATE TABLE "pages" (
"id" BIGSERIAL,
"slug" VARCHAR NOT NULL,
"title" VARCHAR,
"body" TEXT,
"created_at" TIMESTAMP,
"updated_at" TIMESTAMP,
CONSTRAINT "pages_slug_unique" UNIQUE ("slug"),
PRIMARY KEY ("id")
);
CREATE INDEX "pages_created_at_index" ON "pages" ("created_at");
CREATE INDEX "pages_updated_at_index" ON "pages" ("updated_at");
'
        );
    }
}
