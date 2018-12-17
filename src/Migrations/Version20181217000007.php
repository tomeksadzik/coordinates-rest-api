<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217000007 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE point (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, lat NUMERIC(8, 6) NOT NULL, lng NUMERIC(8, 6) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE related_points (point_id INT NOT NULL,related_point_id INT NOT NULL, PRIMARY KEY(point_id, related_point_id)) ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE related_points ADD FOREIGN KEY (point_id) REFERENCES Point(id);');
        $this->addSql('ALTER TABLE related_points ADD FOREIGN KEY (related_point_id) REFERENCES Point(id);');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE point');
        $this->addSql('DROP TABLE related_points');
    }
}
