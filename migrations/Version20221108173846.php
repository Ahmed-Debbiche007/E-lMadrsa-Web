<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108173846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messages CHANGE idmessage idmessage INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE tutorshipsessions CHANGE idsession idsession INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messages CHANGE idmessage idmessage INT NOT NULL');
        $this->addSql('ALTER TABLE tutorshipsessions CHANGE idsession idsession INT NOT NULL');
    }
}
