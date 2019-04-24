<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190424175801 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pregunta ADD pregunta_cat LONGTEXT NOT NULL, ADD pregunta_es LONGTEXT NOT NULL, ADD pregunta_en LONGTEXT NOT NULL, ADD resposta_correcta_cat LONGTEXT NOT NULL, ADD resposta_correcta_es LONGTEXT NOT NULL, ADD resposta_correcta_en LONGTEXT NOT NULL, ADD resposta_incorrecta1cat LONGTEXT NOT NULL, ADD resposta_incorrecta1es LONGTEXT NOT NULL, ADD resposta_incorrecta1en LONGTEXT NOT NULL, ADD resposta_incorrecta2cat LONGTEXT NOT NULL, ADD resposta_incorrecta2es LONGTEXT NOT NULL, ADD resposta_incorrecta2en LONGTEXT NOT NULL, ADD resposta_incorrecta3cat LONGTEXT NOT NULL, ADD resposta_incorrecta3es LONGTEXT NOT NULL, ADD resposta_incorrecta3en LONGTEXT NOT NULL, DROP text, DROP resposta_correcta, DROP resposta_incorrecta1, DROP resposta_incorrecta2, DROP resposta_incorrecta3');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pregunta ADD text LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD resposta_correcta LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD resposta_incorrecta1 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD resposta_incorrecta2 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD resposta_incorrecta3 LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, DROP pregunta_cat, DROP pregunta_es, DROP pregunta_en, DROP resposta_correcta_cat, DROP resposta_correcta_es, DROP resposta_correcta_en, DROP resposta_incorrecta1cat, DROP resposta_incorrecta1es, DROP resposta_incorrecta1en, DROP resposta_incorrecta2cat, DROP resposta_incorrecta2es, DROP resposta_incorrecta2en, DROP resposta_incorrecta3cat, DROP resposta_incorrecta3es, DROP resposta_incorrecta3en');
    }
}
