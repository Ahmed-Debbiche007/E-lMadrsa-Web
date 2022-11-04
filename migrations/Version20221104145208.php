<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221104145208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question (idquestion INT AUTO_INCREMENT NOT NULL, ennonce VARCHAR(255) NOT NULL, option1 VARCHAR(255) NOT NULL, option2 VARCHAR(255) NOT NULL, option3 VARCHAR(255) NOT NULL, answer VARCHAR(255) NOT NULL, idexamen INT NOT NULL, PRIMARY KEY(idquestion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competences CHANGE idCompetence idcompetence INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX id_utilisateur ON evenement');
        $this->addSql('DROP INDEX id_Cat ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE description description VARCHAR(255) NOT NULL, CHANGE date date DATETIME NOT NULL');
        $this->addSql('DROP INDEX Examen_fk1 ON examen');
        $this->addSql('DROP INDEX Examen_fk0 ON examen');
        $this->addSql('ALTER TABLE examen CHANGE idExamen idexamen VARCHAR(255) NOT NULL, CHANGE formationId formationid INT NOT NULL, CHANGE idcategorie idcategorie INT NOT NULL');
        $this->addSql('DROP INDEX Formation_fk2 ON formation');
        $this->addSql('DROP INDEX Formation_fk0 ON formation');
        $this->addSql('DROP INDEX Formation_fk1 ON formation');
        $this->addSql('DROP INDEX Formation_fk3 ON formation');
        $this->addSql('ALTER TABLE formation CHANGE idFormation idformation VARCHAR(255) NOT NULL, CHANGE Difficulté difficulté VARCHAR(255) NOT NULL, CHANGE idPrerequis idprerequis INT NOT NULL, CHANGE idCompetence idcompetence INT NOT NULL, CHANGE idExamen idexamen INT NOT NULL, CHANGE idCategorie idcategorie INT NOT NULL');
        $this->addSql('ALTER TABLE messages DROP status, CHANGE idMessage idmessage INT NOT NULL, CHANGE idSession idsession INT NOT NULL, CHANGE idSender idsender INT NOT NULL, CHANGE body body VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX Participation_fk0 ON participation');
        $this->addSql('DROP INDEX Participation_fk1 ON participation');
        $this->addSql('ALTER TABLE participation CHANGE idParticipation idparticipation INT AUTO_INCREMENT NOT NULL, CHANGE idUser iduser INT NOT NULL, CHANGE idFormation idformation INT NOT NULL, CHANGE resultat resultat DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE post CHANGE postID postid INT AUTO_INCREMENT NOT NULL, CHANGE postCONTENT postcontent VARCHAR(255) NOT NULL, CHANGE userID userid INT NOT NULL, CHANGE categoryID categoryid INT NOT NULL, CHANGE postVOTE postvote INT NOT NULL, CHANGE postNBCOM postnbcom INT NOT NULL, CHANGE postDATE postdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE prerequis CHANGE idPrerequis idprerequis INT AUTO_INCREMENT NOT NULL, CHANGE nomPrerequis nomprerequis VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE idReclamation idreclamation INT AUTO_INCREMENT NOT NULL, CHANGE sujet sujet VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE dateRec daterec DATE NOT NULL, CHANGE idUser iduser INT NOT NULL');
        $this->addSql('ALTER TABLE recup CHANGE idUser iduser INT NOT NULL, CHANGE code code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE requests CHANGE idRequest idrequest INT NOT NULL, CHANGE idTutor idtutor INT NOT NULL, CHANGE idStudent idstudent INT NOT NULL');
        $this->addSql('DROP INDEX fkEv ON reservation');
        $this->addSql('DROP INDEX fkUser ON reservation');
        $this->addSql('ALTER TABLE tutorshipsessions CHANGE idSession idsession INT NOT NULL, CHANGE idStudent idstudent INT NOT NULL, CHANGE idTutor idtutor INT NOT NULL, CHANGE idRequest idrequest INT NOT NULL, CHANGE url url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD id_utilisateur INT AUTO_INCREMENT NOT NULL, ADD mot_de_passe VARCHAR(255) NOT NULL, ADD nom_utilisateur VARCHAR(255) NOT NULL, DROP nomUtilisateur, DROP tel, DROP motDePasse, DROP idUtilisateur, CHANGE email email VARCHAR(180) NOT NULL, CHANGE approved approved TINYINT(1) NOT NULL, CHANGE dateNaissance date_naissance DATE NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_utilisateur)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D37CC8AC ON user (nom_utilisateur)');
        $this->addSql('ALTER TABLE vote CHANGE voteID voteid INT AUTO_INCREMENT NOT NULL, CHANGE userID userid INT NOT NULL, CHANGE postID postid INT NOT NULL');
        $this->addSql('ALTER TABLE votecomment CHANGE votecommentID votecommentid INT AUTO_INCREMENT NOT NULL, CHANGE userID userid INT NOT NULL, CHANGE commentID commentid INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE question');
        $this->addSql('ALTER TABLE competences CHANGE idcompetence idCompetence BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE description description TEXT NOT NULL, CHANGE date date DATE NOT NULL');
        $this->addSql('CREATE INDEX id_utilisateur ON evenement (id_utilisateur)');
        $this->addSql('CREATE INDEX id_Cat ON evenement (id_Cat)');
        $this->addSql('ALTER TABLE examen CHANGE idexamen idExamen BIGINT AUTO_INCREMENT NOT NULL, CHANGE formationid formationId BIGINT DEFAULT NULL, CHANGE idcategorie idcategorie BIGINT DEFAULT NULL');
        $this->addSql('CREATE INDEX Examen_fk1 ON examen (idcategorie)');
        $this->addSql('CREATE INDEX Examen_fk0 ON examen (formationId)');
        $this->addSql('ALTER TABLE formation CHANGE idformation idFormation BIGINT AUTO_INCREMENT NOT NULL, CHANGE difficulté Difficulté VARCHAR(255) DEFAULT NULL, CHANGE idprerequis idPrerequis BIGINT DEFAULT NULL, CHANGE idcompetence idCompetence BIGINT DEFAULT NULL, CHANGE idexamen idExamen BIGINT DEFAULT NULL, CHANGE idcategorie idCategorie BIGINT DEFAULT NULL');
        $this->addSql('CREATE INDEX Formation_fk2 ON formation (idExamen)');
        $this->addSql('CREATE INDEX Formation_fk0 ON formation (idPrerequis)');
        $this->addSql('CREATE INDEX Formation_fk1 ON formation (idCompetence)');
        $this->addSql('CREATE INDEX Formation_fk3 ON formation (idCategorie)');
        $this->addSql('ALTER TABLE messages ADD status VARCHAR(255) NOT NULL, CHANGE idmessage idMessage BIGINT AUTO_INCREMENT NOT NULL, CHANGE idsession idSession BIGINT NOT NULL, CHANGE idsender idSender BIGINT NOT NULL, CHANGE body body TEXT NOT NULL');
        $this->addSql('ALTER TABLE participation CHANGE idparticipation idParticipation BIGINT AUTO_INCREMENT NOT NULL, CHANGE iduser idUser BIGINT DEFAULT NULL, CHANGE idformation idFormation BIGINT DEFAULT NULL, CHANGE resultat resultat DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('CREATE INDEX Participation_fk0 ON participation (idUser)');
        $this->addSql('CREATE INDEX Participation_fk1 ON participation (idFormation)');
        $this->addSql('ALTER TABLE post CHANGE postid postID BIGINT AUTO_INCREMENT NOT NULL, CHANGE postcontent postCONTENT TEXT NOT NULL, CHANGE userid userID BIGINT DEFAULT NULL, CHANGE categoryid categoryID BIGINT DEFAULT NULL, CHANGE postvote postVOTE INT DEFAULT 0 NOT NULL, CHANGE postnbcom postNBCOM INT DEFAULT 0 NOT NULL, CHANGE postdate postDATE DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE prerequis CHANGE idprerequis idPrerequis BIGINT AUTO_INCREMENT NOT NULL, CHANGE nomprerequis nomPrerequis VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE idreclamation idReclamation BIGINT AUTO_INCREMENT NOT NULL, CHANGE sujet sujet VARCHAR(150) NOT NULL, CHANGE description description VARCHAR(500) NOT NULL, CHANGE daterec dateRec DATE DEFAULT NULL, CHANGE iduser idUser BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE recup CHANGE iduser idUser BIGINT NOT NULL, CHANGE code code VARCHAR(15) NOT NULL');
        $this->addSql('ALTER TABLE requests CHANGE idrequest idRequest BIGINT AUTO_INCREMENT NOT NULL, CHANGE idtutor idTutor BIGINT NOT NULL, CHANGE idstudent idStudent BIGINT NOT NULL');
        $this->addSql('CREATE INDEX fkEv ON reservation (id_evenement)');
        $this->addSql('CREATE INDEX fkUser ON reservation (id_utilisateur)');
        $this->addSql('ALTER TABLE tutorshipsessions CHANGE idsession idSession BIGINT AUTO_INCREMENT NOT NULL, CHANGE idstudent idStudent BIGINT NOT NULL, CHANGE idtutor idTutor BIGINT NOT NULL, CHANGE idrequest idRequest BIGINT NOT NULL, CHANGE url url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user MODIFY id_utilisateur INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649D37CC8AC ON user');
        $this->addSql('DROP INDEX `PRIMARY` ON user');
        $this->addSql('ALTER TABLE user ADD nomUtilisateur VARCHAR(255) NOT NULL, ADD tel VARCHAR(255) NOT NULL, ADD motDePasse VARCHAR(255) NOT NULL, ADD idUtilisateur BIGINT AUTO_INCREMENT NOT NULL, DROP id_utilisateur, DROP mot_de_passe, DROP nom_utilisateur, CHANGE email email VARCHAR(255) NOT NULL, CHANGE approved approved TINYINT(1) DEFAULT 0 NOT NULL, CHANGE date_naissance dateNaissance DATE NOT NULL');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (idUtilisateur)');
        $this->addSql('ALTER TABLE vote CHANGE voteid voteID BIGINT AUTO_INCREMENT NOT NULL, CHANGE userid userID BIGINT NOT NULL, CHANGE postid postID BIGINT NOT NULL');
        $this->addSql('ALTER TABLE votecomment CHANGE votecommentid votecommentID BIGINT AUTO_INCREMENT NOT NULL, CHANGE userid userID BIGINT NOT NULL, CHANGE commentid commentID BIGINT NOT NULL');
    }
}
