<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201003152836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE snippet (id INT AUTO_INCREMENT NOT NULL, language_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, code LONGTEXT NOT NULL, INDEX IDX_961C8CD582F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE snippet_tag (snippet_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_485C6E1A6E34B975 (snippet_id), INDEX IDX_485C6E1ABAD26311 (tag_id), PRIMARY KEY(snippet_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE snippet ADD CONSTRAINT FK_961C8CD582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE snippet_tag ADD CONSTRAINT FK_485C6E1A6E34B975 FOREIGN KEY (snippet_id) REFERENCES snippet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE snippet_tag ADD CONSTRAINT FK_485C6E1ABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE snippet DROP FOREIGN KEY FK_961C8CD582F1BAF4');
        $this->addSql('ALTER TABLE snippet_tag DROP FOREIGN KEY FK_485C6E1A6E34B975');
        $this->addSql('ALTER TABLE snippet_tag DROP FOREIGN KEY FK_485C6E1ABAD26311');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE snippet');
        $this->addSql('DROP TABLE snippet_tag');
        $this->addSql('DROP TABLE tag');
    }
}
