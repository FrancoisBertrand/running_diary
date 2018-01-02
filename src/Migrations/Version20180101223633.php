<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180101223633 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE run_diary ADD COLUMN avg_time VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__run_diary AS SELECT id, distance, avg_speed FROM run_diary');
        $this->addSql('DROP TABLE run_diary');
        $this->addSql('CREATE TABLE run_diary (id INTEGER NOT NULL, distance DOUBLE PRECISION NOT NULL, avg_speed DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO run_diary (id, distance, avg_speed) SELECT id, distance, avg_speed FROM __temp__run_diary');
        $this->addSql('DROP TABLE __temp__run_diary');
    }
}
