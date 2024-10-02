<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240912130622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD comment_message VARCHAR(2500) NOT NULL, ADD comment_date_created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE section ADD section_title VARCHAR(160) NOT NULL, ADD section_description VARCHAR(600) DEFAULT NULL');
        $this->addSql('ALTER TABLE tag ADD tag_name VARCHAR(60) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B783B02CC1B0 ON tag (tag_name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP comment_message, DROP comment_date_created');
        $this->addSql('ALTER TABLE section DROP section_title, DROP section_description');
        $this->addSql('DROP INDEX UNIQ_389B783B02CC1B0 ON tag');
        $this->addSql('ALTER TABLE tag DROP tag_name');
    }
}
