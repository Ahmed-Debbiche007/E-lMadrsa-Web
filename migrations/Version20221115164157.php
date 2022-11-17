<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221115164157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BD70548864');
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BDE7F43872');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BD70548864 FOREIGN KEY (id_tutor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BDE7F43872 FOREIGN KEY (id_request_id) REFERENCES requests (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BD70548864');
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BDE7F43872');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BD70548864 FOREIGN KEY (id_tutor_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BDE7F43872 FOREIGN KEY (id_request_id) REFERENCES requests (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
