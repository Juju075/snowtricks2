<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211119173042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add foreigh keys';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, figure_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_9474526CF675F31B (author_id), INDEX IDX_9474526C5C011B5 (figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C5C011B5 FOREIGN KEY (figure_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE trick ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91EF675F31B ON trick (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EF675F31B');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_D8F0A91EF675F31B ON trick');
        $this->addSql('ALTER TABLE trick DROP author_id');
    }
}
