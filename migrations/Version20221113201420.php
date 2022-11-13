<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221113201420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE requests CHANGE idstudent id_student_id INT NOT NULL');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D6516E1ECFCD FOREIGN KEY (id_student_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7B85D6516E1ECFCD ON requests (id_student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D6516E1ECFCD');
        $this->addSql('DROP INDEX IDX_7B85D6516E1ECFCD ON requests');
        $this->addSql('ALTER TABLE requests CHANGE id_student_id idstudent INT NOT NULL');
    }
}
