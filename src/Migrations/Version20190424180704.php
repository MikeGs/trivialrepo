<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190424180704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tipus_pregunta (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pregunta ADD tipus_id INT NOT NULL');
        $this->addSql('ALTER TABLE pregunta ADD CONSTRAINT FK_AEE0E1F7898C381B FOREIGN KEY (tipus_id) REFERENCES tipus_pregunta (id)');
        $this->addSql('CREATE INDEX IDX_AEE0E1F7898C381B ON pregunta (tipus_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pregunta DROP FOREIGN KEY FK_AEE0E1F7898C381B');
        $this->addSql('DROP TABLE tipus_pregunta');
        $this->addSql('DROP INDEX IDX_AEE0E1F7898C381B ON pregunta');
        $this->addSql('ALTER TABLE pregunta DROP tipus_id');
    }
}
