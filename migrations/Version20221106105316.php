<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221106105316 extends AbstractMigration
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
        $this->addSql('CREATE TABLE comment (commentid INT AUTO_INCREMENT NOT NULL, commentcontent VARCHAR(255) NOT NULL, userid INT NOT NULL, postid INT NOT NULL, commentvote INT NOT NULL, commentdate DATETIME NOT NULL, PRIMARY KEY(commentid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competences (idcompetence INT AUTO_INCREMENT NOT NULL, nomcompetence VARCHAR(255) NOT NULL, PRIMARY KEY(idcompetence)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id_evenement INT AUTO_INCREMENT NOT NULL, id_cat INT NOT NULL, nom_evenement VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, id_utilisateur INT NOT NULL, date DATETIME NOT NULL, etat_evenement VARCHAR(255) NOT NULL, PRIMARY KEY(id_evenement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen (idexamen VARCHAR(255) NOT NULL, nomexamen VARCHAR(255) NOT NULL, pourcentage DOUBLE PRECISION NOT NULL, dureeexamen INT NOT NULL, formationid INT NOT NULL, idcategorie INT NOT NULL, PRIMARY KEY(idexamen)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (idformation VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, difficulté VARCHAR(255) NOT NULL, durée INT NOT NULL, idprerequis INT NOT NULL, idcompetence INT NOT NULL, idexamen INT NOT NULL, idcategorie INT NOT NULL, PRIMARY KEY(idformation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (idmessage INT NOT NULL, idsession INT NOT NULL, idsender INT NOT NULL, body VARCHAR(255) NOT NULL, statusdate DATETIME NOT NULL, PRIMARY KEY(idmessage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (idparticipation INT AUTO_INCREMENT NOT NULL, iduser INT NOT NULL, idformation INT NOT NULL, resultat DOUBLE PRECISION NOT NULL, PRIMARY KEY(idparticipation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (postid INT AUTO_INCREMENT NOT NULL, posttitle VARCHAR(255) NOT NULL, postcontent VARCHAR(255) NOT NULL, userid INT NOT NULL, categoryid INT NOT NULL, postvote INT NOT NULL, postnbcom INT NOT NULL, postdate DATETIME NOT NULL, PRIMARY KEY(postid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prerequis (idprerequis INT AUTO_INCREMENT NOT NULL, nomprerequis VARCHAR(100) NOT NULL, PRIMARY KEY(idprerequis)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (idreclamation INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, daterec DATE NOT NULL, iduser INT NOT NULL, PRIMARY KEY(idreclamation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recup (id INT AUTO_INCREMENT NOT NULL, iduser INT NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE requests (idrequest INT NOT NULL, idtutor INT NOT NULL, idstudent INT NOT NULL, type VARCHAR(255) NOT NULL, body VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(idrequest)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id_reservation INT AUTO_INCREMENT NOT NULL, date_reservation DATE NOT NULL, id_evenement INT NOT NULL, id_utilisateur INT NOT NULL, PRIMARY KEY(id_reservation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorshipsessions (idsession INT NOT NULL, idstudent INT NOT NULL, idtutor INT NOT NULL, idrequest INT NOT NULL, url VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(idsession)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, prenom VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, image VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, approved TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (voteid INT AUTO_INCREMENT NOT NULL, userid INT NOT NULL, postid INT NOT NULL, votenb INT NOT NULL, PRIMARY KEY(voteid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE votecomment (votecommentid INT AUTO_INCREMENT NOT NULL, userid INT NOT NULL, commentid INT NOT NULL, votenb INT NOT NULL, PRIMARY KEY(votecommentid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
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
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE recup');
        $this->addSql('DROP TABLE requests');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE tutorshipsessions');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE votecomment');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
