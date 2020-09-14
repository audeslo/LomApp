<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200914152204 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE personne_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE personne (id INT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, datenaissance DATE DEFAULT NULL, sexe VARCHAR(1) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, fonction VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, actif BOOLEAN DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FCEC9EFB03A8386 ON personne (created_by_id)');
        $this->addSql('CREATE INDEX IDX_FCEC9EFDD7B2EBC ON personne (edited_by_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE personne DROP CONSTRAINT FK_FCEC9EFB03A8386');
        $this->addSql('ALTER TABLE personne DROP CONSTRAINT FK_FCEC9EFDD7B2EBC');
        $this->addSql('DROP SEQUENCE personne_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE "user"');
    }
}
