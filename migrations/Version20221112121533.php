<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112121533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX Attestation_fk0 ON attestation');
        $this->addSql('ALTER TABLE attestation CHANGE dateAcq datecq DATE NOT NULL');
        $this->addSql('ALTER TABLE badge CHANGE badgeID badgeid INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE idCategorie idcategorie INT AUTO_INCREMENT NOT NULL, CHANGE nomCategorie nomcategorie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE categorie_ev CHANGE id_Cat id_cat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE categoryID categoryid INT AUTO_INCREMENT NOT NULL, CHANGE categoryIMAGE categoryimage VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX idTutorshipSession ON chatsessions');
        $this->addSql('ALTER TABLE chatsessions CHANGE idSession idsession INT AUTO_INCREMENT NOT NULL, CHANGE idTutorshipSession idtutorshipsession INT NOT NULL');
        $this->addSql('ALTER TABLE comment CHANGE CommentID commentid INT AUTO_INCREMENT NOT NULL, CHANGE CommentCONTENT commentcontent VARCHAR(255) NOT NULL, CHANGE userID userid INT NOT NULL, CHANGE postID postid INT NOT NULL, CHANGE commentVOTE commentvote INT NOT NULL');
        $this->addSql('ALTER TABLE competences CHANGE idCompetence idcompetence INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX id_utilisateur ON evenement');
        $this->addSql('DROP INDEX id_Cat ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE description description VARCHAR(255) NOT NULL, CHANGE date date DATETIME NOT NULL');
        $this->addSql('DROP INDEX Examen_fk1 ON examen');
        $this->addSql('DROP INDEX Examen_fk0 ON examen');
        $this->addSql('ALTER TABLE examen CHANGE idExamen idexamen VARCHAR(255) NOT NULL, CHANGE formationId formationid INT NOT NULL, CHANGE idcategorie idcategorie INT NOT NULL');
        $this->addSql('DROP INDEX Formation_fk0 ON formation');
        $this->addSql('DROP INDEX Formation_fk1 ON formation');
        $this->addSql('DROP INDEX Formation_fk2 ON formation');
        $this->addSql('DROP INDEX Formation_fk3 ON formation');
        $this->addSql('ALTER TABLE formation CHANGE idFormation idformation VARCHAR(255) NOT NULL, CHANGE Difficulté difficulté VARCHAR(255) NOT NULL, CHANGE idPrerequis idprerequis INT NOT NULL, CHANGE idCompetence idcompetence INT NOT NULL, CHANGE idExamen idexamen INT NOT NULL, CHANGE idCategorie idcategorie INT NOT NULL');
        $this->addSql('ALTER TABLE messages DROP status, CHANGE idMessage idmessage INT AUTO_INCREMENT NOT NULL, CHANGE idSession idsession INT NOT NULL, CHANGE idSender idsender INT NOT NULL, CHANGE body body VARCHAR(255) NOT NULL, CHANGE statusDate statusdate DATETIME NOT NULL');
        $this->addSql('DROP INDEX Participation_fk1 ON participation');
        $this->addSql('DROP INDEX Participation_fk0 ON participation');
        $this->addSql('ALTER TABLE participation CHANGE idParticipation idparticipation INT AUTO_INCREMENT NOT NULL, CHANGE idUser iduser INT NOT NULL, CHANGE idFormation idformation INT NOT NULL, CHANGE resultat resultat DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE post ADD user VARCHAR(255) NOT NULL, ADD category VARCHAR(255) NOT NULL, DROP userID, DROP categoryID, CHANGE postID postid INT AUTO_INCREMENT NOT NULL, CHANGE postCONTENT postcontent VARCHAR(255) NOT NULL, CHANGE postVOTE postvote INT NOT NULL, CHANGE postNBCOM postnbcom INT NOT NULL, CHANGE postDATE postdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE prerequis CHANGE idPrerequis idprerequis INT AUTO_INCREMENT NOT NULL, CHANGE nomPrerequis nomprerequis VARCHAR(100) NOT NULL');
        $this->addSql('DROP INDEX Question_fk0 ON question');
        $this->addSql('ALTER TABLE question CHANGE idQuestion idquestion INT AUTO_INCREMENT NOT NULL, CHANGE ennonce ennonce VARCHAR(255) NOT NULL, CHANGE option1 option1 VARCHAR(255) NOT NULL, CHANGE option2 option2 VARCHAR(255) NOT NULL, CHANGE option3 option3 VARCHAR(255) NOT NULL, CHANGE answer answer VARCHAR(255) NOT NULL, CHANGE idExamen idexamen INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE idReclamation idreclamation INT AUTO_INCREMENT NOT NULL, CHANGE sujet sujet VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE dateRec daterec DATE NOT NULL, CHANGE idUser iduser INT NOT NULL');
        $this->addSql('ALTER TABLE recup CHANGE idUser iduser INT NOT NULL, CHANGE code code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE requests ADD id_tutor_id INT DEFAULT NULL, DROP idTutor, CHANGE idRequest idrequest INT AUTO_INCREMENT NOT NULL, CHANGE idStudent idstudent INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_7B85D65170548864 ON requests (id_tutor_id)');
        $this->addSql('DROP INDEX fkEv ON reservation');
        $this->addSql('DROP INDEX fkUser ON reservation');
        $this->addSql('ALTER TABLE tutorshipsessions CHANGE idSession idsession INT AUTO_INCREMENT NOT NULL, CHANGE idStudent idstudent INT NOT NULL, CHANGE idTutor idtutor INT NOT NULL, CHANGE idRequest idrequest INT NOT NULL, CHANGE url url VARCHAR(255) NOT NULL, CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE vote CHANGE voteID voteid INT AUTO_INCREMENT NOT NULL, CHANGE userID userid INT NOT NULL, CHANGE postID postid INT NOT NULL');
        $this->addSql('ALTER TABLE votecomment CHANGE votecommentID votecommentid INT AUTO_INCREMENT NOT NULL, CHANGE userID userid INT NOT NULL, CHANGE commentID commentid INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE attestation CHANGE datecq dateAcq DATE NOT NULL');
        $this->addSql('CREATE INDEX Attestation_fk0 ON attestation (idparticipation)');
        $this->addSql('ALTER TABLE badge CHANGE badgeid badgeID BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE idcategorie idCategorie BIGINT AUTO_INCREMENT NOT NULL, CHANGE nomcategorie nomCategorie VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE categorie_ev CHANGE id_cat id_Cat INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE categoryid categoryID BIGINT AUTO_INCREMENT NOT NULL, CHANGE categoryimage categoryIMAGE VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chatsessions CHANGE idsession idSession BIGINT AUTO_INCREMENT NOT NULL, CHANGE idtutorshipsession idTutorshipSession BIGINT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX idTutorshipSession ON chatsessions (idTutorshipSession)');
        $this->addSql('ALTER TABLE comment CHANGE commentid CommentID BIGINT AUTO_INCREMENT NOT NULL, CHANGE commentcontent CommentCONTENT TEXT NOT NULL, CHANGE userid userID BIGINT DEFAULT NULL, CHANGE postid postID BIGINT NOT NULL, CHANGE commentvote commentVOTE INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE competences CHANGE idcompetence idCompetence BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE description description TEXT NOT NULL, CHANGE date date DATE NOT NULL');
        $this->addSql('CREATE INDEX id_utilisateur ON evenement (id_utilisateur)');
        $this->addSql('CREATE INDEX id_Cat ON evenement (id_Cat)');
        $this->addSql('ALTER TABLE examen CHANGE idexamen idExamen BIGINT AUTO_INCREMENT NOT NULL, CHANGE formationid formationId BIGINT DEFAULT NULL, CHANGE idcategorie idcategorie BIGINT DEFAULT NULL');
        $this->addSql('CREATE INDEX Examen_fk1 ON examen (idcategorie)');
        $this->addSql('CREATE INDEX Examen_fk0 ON examen (formationId)');
        $this->addSql('ALTER TABLE formation CHANGE idformation idFormation BIGINT AUTO_INCREMENT NOT NULL, CHANGE difficulté Difficulté VARCHAR(255) DEFAULT NULL, CHANGE idprerequis idPrerequis BIGINT DEFAULT NULL, CHANGE idcompetence idCompetence BIGINT DEFAULT NULL, CHANGE idexamen idExamen BIGINT DEFAULT NULL, CHANGE idcategorie idCategorie BIGINT DEFAULT NULL');
        $this->addSql('CREATE INDEX Formation_fk0 ON formation (idPrerequis)');
        $this->addSql('CREATE INDEX Formation_fk1 ON formation (idCompetence)');
        $this->addSql('CREATE INDEX Formation_fk2 ON formation (idExamen)');
        $this->addSql('CREATE INDEX Formation_fk3 ON formation (idCategorie)');
        $this->addSql('ALTER TABLE messages ADD status VARCHAR(255) NOT NULL, CHANGE idmessage idMessage BIGINT AUTO_INCREMENT NOT NULL, CHANGE idsession idSession BIGINT NOT NULL, CHANGE idsender idSender BIGINT NOT NULL, CHANGE body body TEXT NOT NULL, CHANGE statusdate statusDate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE participation CHANGE idparticipation idParticipation BIGINT AUTO_INCREMENT NOT NULL, CHANGE iduser idUser BIGINT DEFAULT NULL, CHANGE idformation idFormation BIGINT DEFAULT NULL, CHANGE resultat resultat DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('CREATE INDEX Participation_fk1 ON participation (idFormation)');
        $this->addSql('CREATE INDEX Participation_fk0 ON participation (idUser)');
        $this->addSql('ALTER TABLE post ADD userID BIGINT DEFAULT NULL, ADD categoryID BIGINT DEFAULT NULL, DROP user, DROP category, CHANGE postid postID BIGINT AUTO_INCREMENT NOT NULL, CHANGE postcontent postCONTENT TEXT NOT NULL, CHANGE postvote postVOTE INT DEFAULT 0 NOT NULL, CHANGE postnbcom postNBCOM INT DEFAULT 0 NOT NULL, CHANGE postdate postDATE DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE prerequis CHANGE idprerequis idPrerequis BIGINT AUTO_INCREMENT NOT NULL, CHANGE nomprerequis nomPrerequis VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE idquestion idQuestion BIGINT AUTO_INCREMENT NOT NULL, CHANGE ennonce ennonce VARCHAR(500) NOT NULL, CHANGE option1 option1 VARCHAR(500) NOT NULL, CHANGE option2 option2 VARCHAR(500) NOT NULL, CHANGE option3 option3 VARCHAR(500) NOT NULL, CHANGE answer answer VARCHAR(500) NOT NULL, CHANGE idexamen idExamen BIGINT DEFAULT NULL');
        $this->addSql('CREATE INDEX Question_fk0 ON question (idExamen)');
        $this->addSql('ALTER TABLE reclamation CHANGE idreclamation idReclamation BIGINT AUTO_INCREMENT NOT NULL, CHANGE sujet sujet VARCHAR(150) NOT NULL, CHANGE description description VARCHAR(500) NOT NULL, CHANGE daterec dateRec DATE DEFAULT NULL, CHANGE iduser idUser BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE recup CHANGE iduser idUser BIGINT NOT NULL, CHANGE code code VARCHAR(15) NOT NULL');
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D65170548864');
        $this->addSql('DROP INDEX IDX_7B85D65170548864 ON requests');
        $this->addSql('ALTER TABLE requests ADD idTutor BIGINT NOT NULL, DROP id_tutor_id, CHANGE idrequest idRequest BIGINT AUTO_INCREMENT NOT NULL, CHANGE idstudent idStudent BIGINT NOT NULL');
        $this->addSql('CREATE INDEX fkEv ON reservation (id_evenement)');
        $this->addSql('CREATE INDEX fkUser ON reservation (id_utilisateur)');
        $this->addSql('ALTER TABLE tutorshipsessions CHANGE idsession idSession BIGINT AUTO_INCREMENT NOT NULL, CHANGE idstudent idStudent BIGINT NOT NULL, CHANGE idtutor idTutor BIGINT NOT NULL, CHANGE idrequest idRequest BIGINT NOT NULL, CHANGE url url VARCHAR(255) DEFAULT NULL, CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE vote CHANGE voteid voteID BIGINT AUTO_INCREMENT NOT NULL, CHANGE userid userID BIGINT NOT NULL, CHANGE postid postID BIGINT NOT NULL');
        $this->addSql('ALTER TABLE votecomment CHANGE votecommentid votecommentID BIGINT AUTO_INCREMENT NOT NULL, CHANGE userid userID BIGINT NOT NULL, CHANGE commentid commentID BIGINT NOT NULL');
    }
}
