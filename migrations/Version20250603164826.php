<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250603164826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, emplois_id INT DEFAULT NULL, notes_id INT DEFAULT NULL, documents_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, volume_horaire INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_FDCA8C9C1424CD53 (emplois_id), INDEX IDX_FDCA8C9CFC56F556 (notes_id), INDEX IDX_FDCA8C9C5F0F2752 (documents_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, fichier VARCHAR(255) NOT NULL, date_upload DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE emplois (id INT AUTO_INCREMENT NOT NULL, enseignant_id_id INT DEFAULT NULL, salle VARCHAR(255) NOT NULL, jour VARCHAR(255) NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, INDEX IDX_461274B954E6585E (enseignant_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE enseignants (id INT AUTO_INCREMENT NOT NULL, users_id_id INT DEFAULT NULL, specialite VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_BA5EFB5A98333A1E (users_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE etudiants (id INT AUTO_INCREMENT NOT NULL, users_id_id INT DEFAULT NULL, notes_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_227C02EB98333A1E (users_id_id), INDEX IDX_227C02EBFC56F556 (notes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, note NUMERIC(5, 2) NOT NULL, date_eval DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C1424CD53 FOREIGN KEY (emplois_id) REFERENCES emplois (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CFC56F556 FOREIGN KEY (notes_id) REFERENCES notes (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C5F0F2752 FOREIGN KEY (documents_id) REFERENCES documents (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emplois ADD CONSTRAINT FK_461274B954E6585E FOREIGN KEY (enseignant_id_id) REFERENCES enseignants (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enseignants ADD CONSTRAINT FK_BA5EFB5A98333A1E FOREIGN KEY (users_id_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EB98333A1E FOREIGN KEY (users_id_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EBFC56F556 FOREIGN KEY (notes_id) REFERENCES notes (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C1424CD53
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CFC56F556
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C5F0F2752
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emplois DROP FOREIGN KEY FK_461274B954E6585E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE enseignants DROP FOREIGN KEY FK_BA5EFB5A98333A1E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EB98333A1E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EBFC56F556
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
