<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109230211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen CHANGE idexamen idexamen INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE idexamen idexamen INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examen CHANGE idexamen idexamen VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE idexamen idexamen VARCHAR(255) DEFAULT NULL');
    }
}
