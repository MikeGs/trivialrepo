<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190424182938 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE grup DROP puntuacio_mitja');
        $this->addSql('ALTER TABLE pregunta DROP FOREIGN KEY FK_AEE0E1F788077BAE');
        $this->addSql('DROP INDEX IDX_AEE0E1F788077BAE ON pregunta');
        $this->addSql('ALTER TABLE pregunta DROP id_grup_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE grup ADD puntuacio_mitja DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE pregunta ADD id_grup_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pregunta ADD CONSTRAINT FK_AEE0E1F788077BAE FOREIGN KEY (id_grup_id) REFERENCES grup (id)');
        $this->addSql('CREATE INDEX IDX_AEE0E1F788077BAE ON pregunta (id_grup_id)');
    }
}
