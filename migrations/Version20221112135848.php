<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112135848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE categoryID categoryid INT AUTO_INCREMENT NOT NULL, CHANGE categoryIMAGE categoryimage VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY catfk');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY fkuser');
        $this->addSql('DROP INDEX fkuser ON post');
        $this->addSql('DROP INDEX catfk ON post');
        $this->addSql('ALTER TABLE post ADD user VARCHAR(255) NOT NULL, ADD category VARCHAR(255) NOT NULL, DROP userID, DROP categoryID, CHANGE postID postid INT AUTO_INCREMENT NOT NULL, CHANGE postCONTENT postcontent VARCHAR(255) NOT NULL, CHANGE postDATE postdate DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE categoryid categoryID BIGINT AUTO_INCREMENT NOT NULL, CHANGE categoryimage categoryIMAGE VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD userID INT DEFAULT NULL, ADD categoryID BIGINT DEFAULT NULL, DROP user, DROP category, CHANGE postid postID BIGINT AUTO_INCREMENT NOT NULL, CHANGE postcontent postCONTENT TEXT NOT NULL, CHANGE postdate postDATE DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT catfk FOREIGN KEY (categoryID) REFERENCES category (categoryID) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT fkuser FOREIGN KEY (userID) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX fkuser ON post (userID)');
        $this->addSql('CREATE INDEX catfk ON post (categoryID)');
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D65170548864');
    }
}
