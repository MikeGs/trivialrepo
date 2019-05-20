<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190519164018 extends AbstractMigration
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
        $this->addSql('ALTER TABLE dificultat DROP punts');
        $this->addSql('ALTER TABLE grup ADD puntuacio_facil DOUBLE PRECISION NOT NULL, ADD puntuacio_dificil DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE pregunta DROP FOREIGN KEY FK_AEE0E1F788077BAE');
        $this->addSql('DROP INDEX IDX_AEE0E1F788077BAE ON pregunta');
        $this->addSql('ALTER TABLE pregunta ADD tipus_id INT NOT NULL, ADD pregunta_cat LONGTEXT NOT NULL, ADD pregunta_es LONGTEXT DEFAULT NULL, ADD pregunta_en LONGTEXT DEFAULT NULL, ADD resposta_correcta_cat LONGTEXT DEFAULT NULL, ADD resposta_correcta_es LONGTEXT DEFAULT NULL, ADD resposta_correcta_en LONGTEXT DEFAULT NULL, ADD resposta_incorrecta1cat LONGTEXT DEFAULT NULL, ADD resposta_incorrecta1es LONGTEXT DEFAULT NULL, ADD resposta_incorrecta1en LONGTEXT DEFAULT NULL, ADD resposta_incorrecta2cat LONGTEXT DEFAULT NULL, ADD resposta_incorrecta2es LONGTEXT DEFAULT NULL, ADD resposta_incorrecta2en LONGTEXT DEFAULT NULL, ADD resposta_incorrecta3cat LONGTEXT DEFAULT NULL, ADD resposta_incorrecta3es LONGTEXT DEFAULT NULL, ADD resposta_incorrecta3en LONGTEXT DEFAULT NULL, DROP id_grup_id, DROP text, DROP resposta_correcta, DROP resposta_incorrecta1, DROP resposta_incorrecta2, DROP resposta_incorrecta3');
        $this->addSql('ALTER TABLE pregunta ADD CONSTRAINT FK_AEE0E1F7898C381B FOREIGN KEY (tipus_id) REFERENCES tipus_pregunta (id)');
        $this->addSql('CREATE INDEX IDX_AEE0E1F7898C381B ON pregunta (tipus_id)');
        $this->addSql('ALTER TABLE usuari CHANGE codi_alumne codi_alumne VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pregunta DROP FOREIGN KEY FK_AEE0E1F7898C381B');
        $this->addSql('DROP TABLE tipus_pregunta');
        $this->addSql('ALTER TABLE dificultat ADD punts DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE grup DROP puntuacio_facil, DROP puntuacio_dificil');
        $this->addSql('DROP INDEX IDX_AEE0E1F7898C381B ON pregunta');
        $this->addSql('ALTER TABLE pregunta ADD id_grup_id INT DEFAULT NULL, ADD resposta_correcta LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD resposta_incorrecta1 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD resposta_incorrecta2 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD resposta_incorrecta3 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, DROP tipus_id, DROP pregunta_es, DROP pregunta_en, DROP resposta_correcta_cat, DROP resposta_correcta_es, DROP resposta_correcta_en, DROP resposta_incorrecta1cat, DROP resposta_incorrecta1es, DROP resposta_incorrecta1en, DROP resposta_incorrecta2cat, DROP resposta_incorrecta2es, DROP resposta_incorrecta2en, DROP resposta_incorrecta3cat, DROP resposta_incorrecta3es, DROP resposta_incorrecta3en, CHANGE pregunta_cat text LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE pregunta ADD CONSTRAINT FK_AEE0E1F788077BAE FOREIGN KEY (id_grup_id) REFERENCES grup (id)');
        $this->addSql('CREATE INDEX IDX_AEE0E1F788077BAE ON pregunta (id_grup_id)');
        $this->addSql('ALTER TABLE usuari CHANGE codi_alumne codi_alumne VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
