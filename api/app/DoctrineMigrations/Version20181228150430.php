<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20181228150430 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE oauth_access_token (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_F7FA86A45F37A13B (token), INDEX IDX_F7FA86A419EB6921 (client_id), INDEX IDX_F7FA86A4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_client (id INT AUTO_INCREMENT NOT NULL, random_id VARCHAR(255) NOT NULL, redirect_uris LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', secret VARCHAR(255) NOT NULL, allowed_grant_types LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_refresh_token (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_55DCF7555F37A13B (token), INDEX IDX_55DCF75519EB6921 (client_id), INDEX IDX_55DCF755A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_code (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, redirect_uri LONGTEXT NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_7C5CF3095F37A13B (token), INDEX IDX_7C5CF30919EB6921 (client_id), INDEX IDX_7C5CF309A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oauth_access_token ADD CONSTRAINT FK_F7FA86A419EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id)');
        $this->addSql('ALTER TABLE oauth_access_token ADD CONSTRAINT FK_F7FA86A4A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_refresh_token ADD CONSTRAINT FK_55DCF75519EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id)');
        $this->addSql('ALTER TABLE oauth_refresh_token ADD CONSTRAINT FK_55DCF755A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_code ADD CONSTRAINT FK_7C5CF30919EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id)');
        $this->addSql('ALTER TABLE oauth_code ADD CONSTRAINT FK_7C5CF309A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_favourited RENAME INDEX idx_8a048b9529c1004e TO IDX_1661AAD29C1004E');
        $this->addSql('ALTER TABLE user_video_favourited RENAME INDEX idx_8a048b95a76ed395 TO IDX_1661AADA76ED395');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE oauth_access_token DROP FOREIGN KEY FK_F7FA86A419EB6921');
        $this->addSql('ALTER TABLE oauth_refresh_token DROP FOREIGN KEY FK_55DCF75519EB6921');
        $this->addSql('ALTER TABLE oauth_code DROP FOREIGN KEY FK_7C5CF30919EB6921');
        $this->addSql('DROP TABLE oauth_access_token');
        $this->addSql('DROP TABLE oauth_client');
        $this->addSql('DROP TABLE oauth_refresh_token');
        $this->addSql('DROP TABLE oauth_code');
        $this->addSql('ALTER TABLE user_video_favourited RENAME INDEX idx_1661aad29c1004e TO IDX_8A048B9529C1004E');
        $this->addSql('ALTER TABLE user_video_favourited RENAME INDEX idx_1661aada76ed395 TO IDX_8A048B95A76ED395');
    }
}
