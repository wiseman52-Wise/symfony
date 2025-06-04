<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250604183133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, volume_horaire INT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, cours_id INT NOT NULL, titre VARCHAR(255) NOT NULL, fichier VARCHAR(255) NOT NULL, date_upload DATETIME NOT NULL, INDEX IDX_A2B072887ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE emplois (id INT AUTO_INCREMENT NOT NULL, cours_id INT DEFAULT NULL, enseignant_id INT DEFAULT NULL, salle VARCHAR(255) NOT NULL, jour VARCHAR(255) NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, INDEX IDX_461274B97ECF78B0 (cours_id), INDEX IDX_461274B9E455FCC0 (enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE enseignants (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, specialite VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_BA5EFB5AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE etudiants (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_227C02EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT NOT NULL, cours_id INT NOT NULL, note NUMERIC(5, 2) NOT NULL, date_eval DATE NOT NULL, INDEX IDX_11BA68CDDEAB1A3 (etudiant_id), INDEX IDX_11BA68C7ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE documents ADD CONSTRAINT FK_A2B072887ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emplois ADD CONSTRAINT FK_461274B97ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emplois ADD CONSTRAINT FK_461274B9E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignants (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enseignants ADD CONSTRAINT FK_BA5EFB5AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EBA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes ADD CONSTRAINT FK_11BA68CDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiants (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes ADD CONSTRAINT FK_11BA68C7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE documents DROP FOREIGN KEY FK_A2B072887ECF78B0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emplois DROP FOREIGN KEY FK_461274B97ECF78B0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emplois DROP FOREIGN KEY FK_461274B9E455FCC0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enseignants DROP FOREIGN KEY FK_BA5EFB5AA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EBA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CDDEAB1A3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes DROP FOREIGN KEY FK_11BA68C7ECF78B0
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE cours
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE documents
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE emplois
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE enseignants
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etudiants
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE notes
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE users
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
