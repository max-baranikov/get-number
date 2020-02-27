<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200227130149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE number (number_id INT NOT NULL, PRIMARY KEY(number_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function postUp(Schema $schema): void
    {
        $this->write('Creating stored procedure');

        $this->connection->exec('
            DROP PROCEDURE IF EXISTS AddNumber;
    
            CREATE PROCEDURE AddNumber (IN num_in INT) 
            BEGIN
                DECLARE k INT;
                SELECT COUNT(number.number_id) INTO k FROM number WHERE number.number_id = num_in OR number.number_id = (num_in + 1);
                IF k = 0 THEN
                    INSERT INTO number (number_id) VALUES (num_in);
                    SELECT (num_in + 1) AS result;
                ELSE
                    SELECT (-1) AS result;
                END IF;
            END;
        ');
    }

    public function preDown(Schema $schema): void
    {
        $this->write('Dropping stored procedure');

        $this->connection->exec('
            DROP PROCEDURE IF EXISTS AddNumber;
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE number');
    }
}
