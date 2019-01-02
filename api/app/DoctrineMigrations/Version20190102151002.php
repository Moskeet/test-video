<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20190102151002 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('INSERT INTO `oauth_client`(
                `random_id`,
                `redirect_uris`,
                `secret`,
                `allowed_grant_types`
            ) VALUES(
                \'3ywdlzyn1iyockc0wg0woksgswowss8gso84ow44scwo8ks84k\',
                \'a:2:{i:0;s:53:"http://test-video.loc/app_dev.php/connect/video/check";i:1;s:41:"http://test-video.loc/connect/video/check";}\',
                \'50o6jk94cxgcs0co04wccsk84gkwgo8wc00w40c440c80w88kk\',
                \'a:1:{i:0;s:18:"authorization_code";}\'            
            )');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
