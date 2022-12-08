<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221208194248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE board_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE main_task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sub_task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE work_time_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE board (id INT NOT NULL, project_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_58562B47166D1F9C ON board (project_id)');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, main_task_id INT NOT NULL, start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, duration VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3BAE0AA779FDA86F ON event (main_task_id)');
        $this->addSql('COMMENT ON COLUMN event.duration IS \'(DC2Type:dateinterval)\'');
        $this->addSql('CREATE TABLE main_task (id INT NOT NULL, status_id INT NOT NULL, priority INT DEFAULT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B2CDE9476BF700BD ON main_task (status_id)');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE project_client (project_id INT NOT NULL, client_id INT NOT NULL, PRIMARY KEY(project_id, client_id))');
        $this->addSql('CREATE INDEX IDX_D0E0EF1F166D1F9C ON project_client (project_id)');
        $this->addSql('CREATE INDEX IDX_D0E0EF1F19EB6921 ON project_client (client_id)');
        $this->addSql('CREATE TABLE status (id INT NOT NULL, board_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7B00651CE7EC5785 ON status (board_id)');
        $this->addSql('CREATE TABLE sub_task (id INT NOT NULL, main_task_id INT NOT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75E844E479FDA86F ON sub_task (main_task_id)');
        $this->addSql('CREATE TABLE task (id INT NOT NULL, main_task_id INT DEFAULT NULL, sub_task_id INT DEFAULT NULL, event_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB2579FDA86F ON task (main_task_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB25F26E5D72 ON task (sub_task_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB2571F7E88B ON task (event_id)');
        $this->addSql('CREATE TABLE task_user (task_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(task_id, user_id))');
        $this->addSql('CREATE INDEX IDX_FE2042328DB60186 ON task_user (task_id)');
        $this->addSql('CREATE INDEX IDX_FE204232A76ED395 ON task_user (user_id)');
        $this->addSql('CREATE TABLE work_time (id INT NOT NULL, work_by_id INT DEFAULT NULL, task_id INT DEFAULT NULL, time VARCHAR(255) NOT NULL, message VARCHAR(255) DEFAULT NULL, registered_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9657297D821C5B2B ON work_time (work_by_id)');
        $this->addSql('CREATE INDEX IDX_9657297D8DB60186 ON work_time (task_id)');
        $this->addSql('COMMENT ON COLUMN work_time.time IS \'(DC2Type:dateinterval)\'');
        $this->addSql('COMMENT ON COLUMN work_time.registered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE board ADD CONSTRAINT FK_58562B47166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA779FDA86F FOREIGN KEY (main_task_id) REFERENCES main_task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE main_task ADD CONSTRAINT FK_B2CDE9476BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_client ADD CONSTRAINT FK_D0E0EF1F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_client ADD CONSTRAINT FK_D0E0EF1F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651CE7EC5785 FOREIGN KEY (board_id) REFERENCES board (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sub_task ADD CONSTRAINT FK_75E844E479FDA86F FOREIGN KEY (main_task_id) REFERENCES main_task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2579FDA86F FOREIGN KEY (main_task_id) REFERENCES main_task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25F26E5D72 FOREIGN KEY (sub_task_id) REFERENCES sub_task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2571F7E88B FOREIGN KEY (event_id) REFERENCES event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE2042328DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE204232A76ED395 FOREIGN KEY (user_id) REFERENCES symfony_demo_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_time ADD CONSTRAINT FK_9657297D821C5B2B FOREIGN KEY (work_by_id) REFERENCES symfony_demo_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_time ADD CONSTRAINT FK_9657297D8DB60186 FOREIGN KEY (task_id) REFERENCES task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE board_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE main_task_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sub_task_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE task_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE work_time_id_seq CASCADE');
        $this->addSql('ALTER TABLE board DROP CONSTRAINT FK_58562B47166D1F9C');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA779FDA86F');
        $this->addSql('ALTER TABLE main_task DROP CONSTRAINT FK_B2CDE9476BF700BD');
        $this->addSql('ALTER TABLE project_client DROP CONSTRAINT FK_D0E0EF1F166D1F9C');
        $this->addSql('ALTER TABLE project_client DROP CONSTRAINT FK_D0E0EF1F19EB6921');
        $this->addSql('ALTER TABLE status DROP CONSTRAINT FK_7B00651CE7EC5785');
        $this->addSql('ALTER TABLE sub_task DROP CONSTRAINT FK_75E844E479FDA86F');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB2579FDA86F');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25F26E5D72');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB2571F7E88B');
        $this->addSql('ALTER TABLE task_user DROP CONSTRAINT FK_FE2042328DB60186');
        $this->addSql('ALTER TABLE task_user DROP CONSTRAINT FK_FE204232A76ED395');
        $this->addSql('ALTER TABLE work_time DROP CONSTRAINT FK_9657297D821C5B2B');
        $this->addSql('ALTER TABLE work_time DROP CONSTRAINT FK_9657297D8DB60186');
        $this->addSql('DROP TABLE board');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE main_task');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_client');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE sub_task');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_user');
        $this->addSql('DROP TABLE work_time');
    }
}
