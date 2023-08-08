<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808181726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE commune_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fokontany_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mipetraka_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE olona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sary_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE commune (id INT NOT NULL, nom VARCHAR(50) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN commune.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN commune.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE fokontany (id INT NOT NULL, commune_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E9452B46131A4F72 ON fokontany (commune_id)');
        $this->addSql('COMMENT ON COLUMN fokontany.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN fokontany.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE mipetraka (id INT NOT NULL, fokontany_id INT DEFAULT NULL, olona_id INT DEFAULT NULL, date_entree DATE DEFAULT NULL, date_sortie DATE DEFAULT NULL, observation TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_81DEBA262907CDD ON mipetraka (fokontany_id)');
        $this->addSql('CREATE INDEX IDX_81DEBA2E5C5B308 ON mipetraka (olona_id)');
        $this->addSql('COMMENT ON COLUMN mipetraka.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN mipetraka.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE olona (id INT NOT NULL, sary_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(100) DEFAULT NULL, date_naissance DATE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2EF0C4C08F6189AC ON olona (sary_id)');
        $this->addSql('COMMENT ON COLUMN olona.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN olona.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE sary (id INT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, file_size VARCHAR(255) DEFAULT NULL, table_mere VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN sary.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN sary.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE fokontany ADD CONSTRAINT FK_E9452B46131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mipetraka ADD CONSTRAINT FK_81DEBA262907CDD FOREIGN KEY (fokontany_id) REFERENCES fokontany (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mipetraka ADD CONSTRAINT FK_81DEBA2E5C5B308 FOREIGN KEY (olona_id) REFERENCES olona (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE olona ADD CONSTRAINT FK_2EF0C4C08F6189AC FOREIGN KEY (sary_id) REFERENCES sary (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE commune_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fokontany_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mipetraka_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE olona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sary_id_seq CASCADE');
        $this->addSql('ALTER TABLE fokontany DROP CONSTRAINT FK_E9452B46131A4F72');
        $this->addSql('ALTER TABLE mipetraka DROP CONSTRAINT FK_81DEBA262907CDD');
        $this->addSql('ALTER TABLE mipetraka DROP CONSTRAINT FK_81DEBA2E5C5B308');
        $this->addSql('ALTER TABLE olona DROP CONSTRAINT FK_2EF0C4C08F6189AC');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE fokontany');
        $this->addSql('DROP TABLE mipetraka');
        $this->addSql('DROP TABLE olona');
        $this->addSql('DROP TABLE sary');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
