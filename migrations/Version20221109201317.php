<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109201317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_ev ADD evenements_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie_ev ADD CONSTRAINT FK_E3F9D96963C02CD4 FOREIGN KEY (evenements_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_E3F9D96963C02CD4 ON categorie_ev (evenements_id)');
        $this->addSql('ALTER TABLE evenement MODIFY id_evenement INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON evenement');
        $this->addSql('ALTER TABLE evenement DROP id_cat, DROP id_utilisateur, CHANGE id_evenement id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user ADD evenements_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64963C02CD4 FOREIGN KEY (evenements_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64963C02CD4 ON user (evenements_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_ev DROP FOREIGN KEY FK_E3F9D96963C02CD4');
        $this->addSql('DROP INDEX IDX_E3F9D96963C02CD4 ON categorie_ev');
        $this->addSql('ALTER TABLE categorie_ev DROP evenements_id');
        $this->addSql('ALTER TABLE evenement MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON evenement');
        $this->addSql('ALTER TABLE evenement ADD id_cat INT NOT NULL, ADD id_utilisateur INT NOT NULL, CHANGE id id_evenement INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD PRIMARY KEY (id_evenement)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64963C02CD4');
        $this->addSql('DROP INDEX IDX_8D93D64963C02CD4 ON user');
        $this->addSql('ALTER TABLE user DROP evenements_id');
    }
}
