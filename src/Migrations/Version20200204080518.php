<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200204080518 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE completed (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, test_id INT NOT NULL, INDEX IDX_3AF85C6EA76ED395 (user_id), INDEX IDX_3AF85C6E1E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_answer_answer_item (user_answer_id INT NOT NULL, answer_item_id INT NOT NULL, INDEX IDX_2C7AB006AAD3C5E3 (user_answer_id), INDEX IDX_2C7AB0065A2F9D2F (answer_item_id), PRIMARY KEY(user_answer_id, answer_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE completed ADD CONSTRAINT FK_3AF85C6EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE completed ADD CONSTRAINT FK_3AF85C6E1E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE user_answer_answer_item ADD CONSTRAINT FK_2C7AB006AAD3C5E3 FOREIGN KEY (user_answer_id) REFERENCES user_answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_answer_answer_item ADD CONSTRAINT FK_2C7AB0065A2F9D2F FOREIGN KEY (answer_item_id) REFERENCES answer_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_type CHANGE name type VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE user_answer DROP INDEX UNIQ_BF8F51181E27F6BF, ADD INDEX IDX_BF8F51181E27F6BF (question_id)');
        $this->addSql('DROP INDEX UNIQ_BF8F5118AA334807 ON user_answer');
        $this->addSql('DROP INDEX IDX_BF8F5118A76ED395 ON user_answer');
        $this->addSql('ALTER TABLE user_answer DROP answer_id, CHANGE user_id completed_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F511881604B56 FOREIGN KEY (completed_id) REFERENCES completed (id)');
        $this->addSql('CREATE INDEX IDX_BF8F511881604B56 ON user_answer (completed_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_answer DROP FOREIGN KEY FK_BF8F511881604B56');
        $this->addSql('ALTER TABLE completed DROP FOREIGN KEY FK_3AF85C6EA76ED395');
        $this->addSql('DROP TABLE completed');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_answer_answer_item');
        $this->addSql('ALTER TABLE question_type CHANGE type name VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user_answer DROP INDEX IDX_BF8F51181E27F6BF, ADD UNIQUE INDEX UNIQ_BF8F51181E27F6BF (question_id)');
        $this->addSql('DROP INDEX IDX_BF8F511881604B56 ON user_answer');
        $this->addSql('ALTER TABLE user_answer ADD answer_id INT DEFAULT NULL, CHANGE completed_id user_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF8F5118AA334807 ON user_answer (answer_id)');
        $this->addSql('CREATE INDEX IDX_BF8F5118A76ED395 ON user_answer (user_id)');
    }
}
