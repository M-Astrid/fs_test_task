<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200204013450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE answer_item (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, text LONGTEXT NOT NULL, is_right TINYINT(1) DEFAULT NULL, INDEX IDX_4130C6DE1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE completed (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, test_id INT NOT NULL, INDEX IDX_3AF85C6EA76ED395 (user_id), INDEX IDX_3AF85C6E1E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, test_id INT NOT NULL, text LONGTEXT NOT NULL, INDEX IDX_B6F7494EC54C8C93 (type_id), INDEX IDX_B6F7494E1E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_answer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, completed_id INT NOT NULL, answer_text VARCHAR(255) DEFAULT NULL, INDEX IDX_BF8F51181E27F6BF (question_id), INDEX IDX_BF8F511881604B56 (completed_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_answer_answer_item (user_answer_id INT NOT NULL, answer_item_id INT NOT NULL, INDEX IDX_2C7AB006AAD3C5E3 (user_answer_id), INDEX IDX_2C7AB0065A2F9D2F (answer_item_id), PRIMARY KEY(user_answer_id, answer_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer_item ADD CONSTRAINT FK_4130C6DE1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE completed ADD CONSTRAINT FK_3AF85C6EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE completed ADD CONSTRAINT FK_3AF85C6E1E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EC54C8C93 FOREIGN KEY (type_id) REFERENCES question_type (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E1E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F51181E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F511881604B56 FOREIGN KEY (completed_id) REFERENCES completed (id)');
        $this->addSql('ALTER TABLE user_answer_answer_item ADD CONSTRAINT FK_2C7AB006AAD3C5E3 FOREIGN KEY (user_answer_id) REFERENCES user_answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_answer_answer_item ADD CONSTRAINT FK_2C7AB0065A2F9D2F FOREIGN KEY (answer_item_id) REFERENCES answer_item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_answer_answer_item DROP FOREIGN KEY FK_2C7AB0065A2F9D2F');
        $this->addSql('ALTER TABLE user_answer DROP FOREIGN KEY FK_BF8F511881604B56');
        $this->addSql('ALTER TABLE answer_item DROP FOREIGN KEY FK_4130C6DE1E27F6BF');
        $this->addSql('ALTER TABLE user_answer DROP FOREIGN KEY FK_BF8F51181E27F6BF');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EC54C8C93');
        $this->addSql('ALTER TABLE completed DROP FOREIGN KEY FK_3AF85C6E1E5D0459');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E1E5D0459');
        $this->addSql('ALTER TABLE user_answer_answer_item DROP FOREIGN KEY FK_2C7AB006AAD3C5E3');
        $this->addSql('DROP TABLE answer_item');
        $this->addSql('DROP TABLE completed');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_type');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE user_answer');
        $this->addSql('DROP TABLE user_answer_answer_item');
    }
}
