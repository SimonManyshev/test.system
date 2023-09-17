<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace DoctrineMigrations;

use App\Shared\Infrastructure\Migration\AppAbstractMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20230917142102 extends AppAbstractMigration
{
    public function getDescription(): string
    {
        return 'Создает таблицы testing.attempt и testing.response';
    }

    public function up(Schema $schema): void
    {
        $multiSql = <<<SQL
        --- Таблица попыток прохождений тестов
            CREATE SEQUENCE "testing_attempt_id_seq" INCREMENT BY 1 MINVALUE 1 START 1;

            CREATE TABLE testing.attempt (
                id INT PRIMARY KEY DEFAULT NEXTVAL('testing_attempt_id_seq'),
                test_id INT NOT NULL,
                user_name VARCHAR(512) NOT NULL,
                createdAt TIMESTAMP NOT NULL DEFAULT NOW() 
            );

            ALTER TABLE testing.attempt ADD CONSTRAINT user_name_unique UNIQUE (user_name);

            ALTER TABLE testing.attempt
                ADD CONSTRAINT test_fk
                FOREIGN KEY (test_id)
                REFERENCES dictionary.test(id);

            COMMENT ON TABLE testing.attempt IS 'Таблица попыток прохождений тестов';

            COMMENT ON COLUMN testing.attempt.id IS 'Уникальный идентификатор попытки';
            COMMENT ON COLUMN testing.attempt.test_id IS 'Ссылка на тест (dictionary.test.id)';
            COMMENT ON COLUMN testing.attempt.user_name IS 'Имя тестируемого Юзера';
            COMMENT ON COLUMN testing.attempt.user_name IS 'Время создания попытки';

        --- Таблица ответов Юзера
            CREATE SEQUENCE "testing_response_id_seq" INCREMENT BY 1 MINVALUE 1 START 1;

            CREATE TABLE testing.response (
                id INT PRIMARY KEY DEFAULT NEXTVAL('testing_response_id_seq'),
                test_id INT NOT NULL,
                attempt_id INT NOT NULL,
                response_id INT NOT NULL
            );

            ALTER TABLE testing.response
                ADD CONSTRAINT test_fk
                FOREIGN KEY (test_id)
                REFERENCES dictionary.test(id);

            ALTER TABLE testing.response
                ADD CONSTRAINT attempt_fk
                FOREIGN KEY (attempt_id)
                REFERENCES testing.attempt(id);

            ALTER TABLE testing.response
                ADD CONSTRAINT response_fk
                FOREIGN KEY (response_id)
                REFERENCES dictionary.response(id);
                                
            COMMENT ON TABLE testing.response IS 'Таблица ответов Юзера';

            COMMENT ON COLUMN testing.response.id IS 'Уникальный идентификатор ответов Юзера';
            COMMENT ON COLUMN testing.response.test_id IS 'Ссылка на тест (dictionary.test.id)';
            COMMENT ON COLUMN testing.response.attempt_id IS 'Ссылка на попытку прохождения теста (testing.attempt.id)';
            COMMENT ON COLUMN testing.response.response_id IS 'Ссылка на ответ (dictionary.response.id)';
        SQL;

        $this->addMultiSql($multiSql);
    }
}
