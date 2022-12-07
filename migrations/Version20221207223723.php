<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207223723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, badgetype VARCHAR(255) NOT NULL, badgeimage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE badge_user (badge_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_299D3A50F7A2C2FC (badge_id), INDEX IDX_299D3A50A76ED395 (user_id), PRIMARY KEY(badge_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE categorie_ev (id INT AUTO_INCREMENT NOT NULL, type_evenement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE chatsessions (idsession INT AUTO_INCREMENT NOT NULL, idtutorshipsession INT NOT NULL, PRIMARY KEY(idsession)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');


        $this->addSql('CREATE TABLE daily_result (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, id_cate_id INT NOT NULL, id_user_id INT NOT NULL, nom_evenement VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, date DATETIME NOT NULL, etat_evenement VARCHAR(255) NOT NULL, INDEX IDX_B26681EA3ADA195 (id_cate_id), INDEX IDX_B26681E79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');


        $this->addSql('CREATE TABLE messages (idmessage INT AUTO_INCREMENT NOT NULL, idsession_id INT NOT NULL, idsender INT NOT NULL, body VARCHAR(255) NOT NULL, statusdate DATETIME NOT NULL, INDEX IDX_DB021E96AC96F1E5 (idsession_id), PRIMARY KEY(idmessage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');





        $this->addSql('CREATE TABLE recup (id INT AUTO_INCREMENT NOT NULL, iduser INT NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE requests (id INT AUTO_INCREMENT NOT NULL, id_tutor_id INT DEFAULT NULL, id_student_id INT NOT NULL, type VARCHAR(255) NOT NULL, body VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_7B85D65170548864 (id_tutor_id), INDEX IDX_7B85D6516E1ECFCD (id_student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id_reservation INT AUTO_INCREMENT NOT NULL, date_reservation DATE NOT NULL, id_evenement INT NOT NULL, id_utilisateur INT NOT NULL, PRIMARY KEY(id_reservation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, token VARCHAR(255) NOT NULL, refresh VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorshipsessions (id INT AUTO_INCREMENT NOT NULL, id_student_id INT DEFAULT NULL, id_tutor_id INT DEFAULT NULL, id_request_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date DATETIME NOT NULL, body VARCHAR(255) NOT NULL, INDEX IDX_6C7DB1BD6E1ECFCD (id_student_id), INDEX IDX_6C7DB1BD70548864 (id_tutor_id), UNIQUE INDEX UNIQ_6C7DB1BDE7F43872 (id_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, prenom VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, image VARCHAR(180) NOT NULL, roles JSON NOT NULL, role VARCHAR(255) DEFAULT \'User\' NOT NULL, password VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, approved TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');



        $this->addSql('ALTER TABLE badge_user ADD CONSTRAINT FK_299D3A50F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE badge_user ADD CONSTRAINT FK_299D3A50A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');


        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EA3ADA195 FOREIGN KEY (id_cate_id) REFERENCES categorie_ev (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');






        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96AC96F1E5 FOREIGN KEY (idsession_id) REFERENCES tutorshipsessions (id)');






        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D65170548864 FOREIGN KEY (id_tutor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D6516E1ECFCD FOREIGN KEY (id_student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BD6E1ECFCD FOREIGN KEY (id_student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BD70548864 FOREIGN KEY (id_tutor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BDE7F43872 FOREIGN KEY (id_request_id) REFERENCES requests (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
       
        $this->addSql('ALTER TABLE badge_user DROP FOREIGN KEY FK_299D3A50F7A2C2FC');
        $this->addSql('ALTER TABLE badge_user DROP FOREIGN KEY FK_299D3A50A76ED395');
        
        
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EA3ADA195');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E79F37AE5');
        
        
        
        
        
        
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96AC96F1E5');
        
        
        
        
        
        
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D65170548864');
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D6516E1ECFCD');
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BD6E1ECFCD');
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BD70548864');
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BDE7F43872');
        
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE badge_user');
        
        $this->addSql('DROP TABLE categorie_ev');
        
        $this->addSql('DROP TABLE chatsessions');
        
        
        $this->addSql('DROP TABLE daily_result');
        $this->addSql('DROP TABLE evenement');
        
        
        $this->addSql('DROP TABLE messages');
        
        
        
        
        
        $this->addSql('DROP TABLE recup');
        $this->addSql('DROP TABLE requests');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP TABLE tutorshipsessions');
        $this->addSql('DROP TABLE user');
        
    }
}
