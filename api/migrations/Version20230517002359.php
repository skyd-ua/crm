<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517002359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE item (id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, quantity INT NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE item_components (item_id INT NOT NULL, item_item_id INT NOT NULL, PRIMARY KEY(item_id, item_item_id))');
        $this->addSql('CREATE INDEX IDX_53F9DDF7126F525E ON item_components (item_id)');
        $this->addSql('CREATE INDEX IDX_53F9DDF71932740A ON item_components (item_item_id)');
        $this->addSql('ALTER TABLE item_components ADD CONSTRAINT FK_53F9DDF7126F525E FOREIGN KEY (item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_components ADD CONSTRAINT FK_53F9DDF71932740A FOREIGN KEY (item_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE item_id_seq CASCADE');
        $this->addSql('ALTER TABLE item_components DROP CONSTRAINT FK_53F9DDF7126F525E');
        $this->addSql('ALTER TABLE item_components DROP CONSTRAINT FK_53F9DDF71932740A');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_components');
    }
}
