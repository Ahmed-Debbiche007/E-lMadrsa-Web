<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116234457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attestation (idattestation INT AUTO_INCREMENT NOT NULL, idparticipation INT NOT NULL, datecq DATE NOT NULL, PRIMARY KEY(idattestation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE badge (badgeid INT AUTO_INCREMENT NOT NULL, badgetype VARCHAR(255) NOT NULL, badgeimage VARCHAR(255) NOT NULL, PRIMARY KEY(badgeid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (idcategorie INT AUTO_INCREMENT NOT NULL, nomcategorie VARCHAR(255) NOT NULL, PRIMARY KEY(idcategorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_ev (id_cat VARCHAR(255) NOT NULL, type_evenement VARCHAR(255) NOT NULL, PRIMARY KEY(id_cat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (categoryid INT AUTO_INCREMENT NOT NULL, categoryname VARCHAR(255) NOT NULL, categoryimage VARCHAR(255) NOT NULL, PRIMARY KEY(categoryid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chatsessions (idsession INT AUTO_INCREMENT NOT NULL, idtutorshipsession INT NOT NULL, PRIMARY KEY(idsession)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (commentid INT AUTO_INCREMENT NOT NULL, userid INT DEFAULT NULL, postid INT DEFAULT NULL, commentcontent VARCHAR(255) NOT NULL, commentvote INT NOT NULL, commentdate DATETIME NOT NULL, INDEX IDX_9474526CF132696E (userid), INDEX IDX_9474526C7510F6AF (postid), PRIMARY KEY(commentid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competences (idcompetence INT AUTO_INCREMENT NOT NULL, nomcompetence VARCHAR(255) NOT NULL, PRIMARY KEY(idcompetence)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id_evenement INT AUTO_INCREMENT NOT NULL, id_cat INT NOT NULL, nom_evenement VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, id_utilisateur INT NOT NULL, date DATETIME NOT NULL, etat_evenement VARCHAR(255) NOT NULL, PRIMARY KEY(id_evenement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen (idexamen VARCHAR(255) NOT NULL, formationid VARCHAR(255) DEFAULT NULL, idcategorie INT DEFAULT NULL, nomexamen VARCHAR(255) NOT NULL, pourcentage DOUBLE PRECISION NOT NULL, dureeexamen INT NOT NULL, INDEX IDX_514C8FEC900D8539 (formationid), INDEX IDX_514C8FEC37667FC1 (idcategorie), PRIMARY KEY(idexamen)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (idformation VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, difficulté VARCHAR(255) NOT NULL, durée INT NOT NULL, idprerequis INT NOT NULL, idcompetence INT NOT NULL, idexamen INT NOT NULL, idcategorie INT NOT NULL, PRIMARY KEY(idformation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (idmessage INT AUTO_INCREMENT NOT NULL, idsession INT NOT NULL, idsender INT NOT NULL, body VARCHAR(255) NOT NULL, statusdate DATETIME NOT NULL, PRIMARY KEY(idmessage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (idparticipation INT AUTO_INCREMENT NOT NULL, idformation VARCHAR(255) DEFAULT NULL, resultat DOUBLE PRECISION NOT NULL, idUser INT DEFAULT NULL, INDEX IDX_AB55E24FFE6E88D7 (idUser), INDEX IDX_AB55E24F3E5B884A (idformation), PRIMARY KEY(idparticipation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (postid INT AUTO_INCREMENT NOT NULL, categoryid INT DEFAULT NULL, posttitle VARCHAR(255) NOT NULL, postcontent VARCHAR(255) NOT NULL, postvote INT NOT NULL, postnbcom INT NOT NULL, postdate DATETIME NOT NULL, UserID INT DEFAULT NULL, INDEX IDX_5A8A6C8D58746832 (UserID), INDEX IDX_5A8A6C8D9B32FD3 (categoryid), PRIMARY KEY(postid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prerequis (idprerequis INT AUTO_INCREMENT NOT NULL, nomprerequis VARCHAR(100) NOT NULL, PRIMARY KEY(idprerequis)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (idquestion INT AUTO_INCREMENT NOT NULL, idexamen VARCHAR(255) DEFAULT NULL, ennonce VARCHAR(500) NOT NULL, option1 VARCHAR(500) NOT NULL, option2 VARCHAR(500) NOT NULL, option3 VARCHAR(500) NOT NULL, answer VARCHAR(500) NOT NULL, INDEX IDX_B6F7494E35F12240 (idexamen), PRIMARY KEY(idquestion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (idreclamation INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, daterec DATE NOT NULL, iduser INT NOT NULL, PRIMARY KEY(idreclamation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recup (id INT AUTO_INCREMENT NOT NULL, iduser INT NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE requests (id INT AUTO_INCREMENT NOT NULL, id_tutor_id INT DEFAULT NULL, id_student_id INT NOT NULL, type VARCHAR(255) NOT NULL, body VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_7B85D65170548864 (id_tutor_id), INDEX IDX_7B85D6516E1ECFCD (id_student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id_reservation INT AUTO_INCREMENT NOT NULL, date_reservation DATE NOT NULL, id_evenement INT NOT NULL, id_utilisateur INT NOT NULL, PRIMARY KEY(id_reservation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, token VARCHAR(255) NOT NULL, refresh VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorshipsessions (idsession INT AUTO_INCREMENT NOT NULL, id_student_id INT DEFAULT NULL, id_tutor_id INT DEFAULT NULL, id_request_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date DATETIME NOT NULL, body VARCHAR(255) NOT NULL, INDEX IDX_6C7DB1BD6E1ECFCD (id_student_id), INDEX IDX_6C7DB1BD70548864 (id_tutor_id), UNIQUE INDEX UNIQ_6C7DB1BDE7F43872 (id_request_id), PRIMARY KEY(idsession)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, prenom VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, image VARCHAR(180) NOT NULL, roles JSON NOT NULL, role VARCHAR(255) DEFAULT \'User\' NOT NULL, password VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, approved TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (voteid INT AUTO_INCREMENT NOT NULL, userid INT NOT NULL, postid INT NOT NULL, votenb INT NOT NULL, PRIMARY KEY(voteid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE votecomment (votecommentid INT AUTO_INCREMENT NOT NULL, userid INT NOT NULL, commentid INT NOT NULL, votenb INT NOT NULL, PRIMARY KEY(votecommentid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF132696E FOREIGN KEY (userid) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7510F6AF FOREIGN KEY (postid) REFERENCES post (postid)');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FEC900D8539 FOREIGN KEY (formationid) REFERENCES formation (idformation)');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FEC37667FC1 FOREIGN KEY (idcategorie) REFERENCES categorie (idcategorie)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F3E5B884A FOREIGN KEY (idformation) REFERENCES formation (idformation)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D58746832 FOREIGN KEY (UserID) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D9B32FD3 FOREIGN KEY (categoryid) REFERENCES category (categoryid)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E35F12240 FOREIGN KEY (idexamen) REFERENCES examen (idexamen)');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D65170548864 FOREIGN KEY (id_tutor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D6516E1ECFCD FOREIGN KEY (id_student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BD6E1ECFCD FOREIGN KEY (id_student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BD70548864 FOREIGN KEY (id_tutor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tutorshipsessions ADD CONSTRAINT FK_6C7DB1BDE7F43872 FOREIGN KEY (id_request_id) REFERENCES requests (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF132696E');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7510F6AF');
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FEC900D8539');
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FEC37667FC1');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FFE6E88D7');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F3E5B884A');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D58746832');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D9B32FD3');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E35F12240');
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D65170548864');
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D6516E1ECFCD');
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BD6E1ECFCD');
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BD70548864');
        $this->addSql('ALTER TABLE tutorshipsessions DROP FOREIGN KEY FK_6C7DB1BDE7F43872');
        $this->addSql('DROP TABLE attestation');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_ev');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE chatsessions');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE examen');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE prerequis');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE recup');
        $this->addSql('DROP TABLE requests');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP TABLE tutorshipsessions');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE votecomment');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
