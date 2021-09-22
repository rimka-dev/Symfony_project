<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611134016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type_logement TINYINT(1) NOT NULL, prix INT NOT NULL, nbr_chambre INT NOT NULL, spf_chambre DOUBLE PRECISION NOT NULL, chambre_meub TINYINT(1) NOT NULL, nbr_sdb INT NOT NULL, superficie DOUBLE PRECISION NOT NULL, nbr_colocataire SMALLINT NOT NULL, img_1 VARCHAR(255) NOT NULL, img2 VARCHAR(255) DEFAULT NULL, img3 VARCHAR(255) DEFAULT NULL, img4 VARCHAR(255) DEFAULT NULL, animaux TINYINT(1) NOT NULL, animaux_chat TINYINT(1) NOT NULL, animaux_chien TINYINT(1) DEFAULT NULL, animaux_rongeur TINYINT(1) DEFAULT NULL, animaux_autres VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, comp_adresse VARCHAR(255) DEFAULT NULL, code_postal INT NOT NULL, date_creation DATETIME NOT NULL, pref_genre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, fumeur TINYINT(1) NOT NULL, INDEX IDX_CB988C6FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_user (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receveur_id INT DEFAULT NULL, date DATETIME NOT NULL, sujet VARCHAR(255) DEFAULT NULL, message LONGTEXT NOT NULL, INDEX IDX_A56C54B6F624B39D (sender_id), INDEX IDX_A56C54B6B967E626 (receveur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipements (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipements_annonces (equipements_id INT NOT NULL, annonces_id INT NOT NULL, INDEX IDX_8C251F8E852CCFF5 (equipements_id), INDEX IDX_8C251F8E4C2885D7 (annonces_id), PRIMARY KEY(equipements_id, annonces_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loisirs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loisirs_annonces (loisirs_id INT NOT NULL, annonces_id INT NOT NULL, INDEX IDX_4C41ADD6F5CC4DB6 (loisirs_id), INDEX IDX_4C41ADD64C2885D7 (annonces_id), PRIMARY KEY(loisirs_id, annonces_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temoignage (id INT AUTO_INCREMENT NOT NULL, temoin_id INT NOT NULL, hebergeur_id INT DEFAULT NULL, date DATETIME NOT NULL, temoignage LONGTEXT NOT NULL, INDEX IDX_BDADBC461655312C (temoin_id), INDEX IDX_BDADBC4626B797A0 (hebergeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age SMALLINT NOT NULL, img_avatar VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, adresse_user VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact_user ADD CONSTRAINT FK_A56C54B6F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contact_user ADD CONSTRAINT FK_A56C54B6B967E626 FOREIGN KEY (receveur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE equipements_annonces ADD CONSTRAINT FK_8C251F8E852CCFF5 FOREIGN KEY (equipements_id) REFERENCES equipements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipements_annonces ADD CONSTRAINT FK_8C251F8E4C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loisirs_annonces ADD CONSTRAINT FK_4C41ADD6F5CC4DB6 FOREIGN KEY (loisirs_id) REFERENCES loisirs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loisirs_annonces ADD CONSTRAINT FK_4C41ADD64C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE temoignage ADD CONSTRAINT FK_BDADBC461655312C FOREIGN KEY (temoin_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE temoignage ADD CONSTRAINT FK_BDADBC4626B797A0 FOREIGN KEY (hebergeur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipements_annonces DROP FOREIGN KEY FK_8C251F8E4C2885D7');
        $this->addSql('ALTER TABLE loisirs_annonces DROP FOREIGN KEY FK_4C41ADD64C2885D7');
        $this->addSql('ALTER TABLE equipements_annonces DROP FOREIGN KEY FK_8C251F8E852CCFF5');
        $this->addSql('ALTER TABLE loisirs_annonces DROP FOREIGN KEY FK_4C41ADD6F5CC4DB6');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FA76ED395');
        $this->addSql('ALTER TABLE contact_user DROP FOREIGN KEY FK_A56C54B6F624B39D');
        $this->addSql('ALTER TABLE contact_user DROP FOREIGN KEY FK_A56C54B6B967E626');
        $this->addSql('ALTER TABLE temoignage DROP FOREIGN KEY FK_BDADBC461655312C');
        $this->addSql('ALTER TABLE temoignage DROP FOREIGN KEY FK_BDADBC4626B797A0');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE contact_user');
        $this->addSql('DROP TABLE equipements');
        $this->addSql('DROP TABLE equipements_annonces');
        $this->addSql('DROP TABLE loisirs');
        $this->addSql('DROP TABLE loisirs_annonces');
        $this->addSql('DROP TABLE temoignage');
        $this->addSql('DROP TABLE user');
    }
}
