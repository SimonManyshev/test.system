<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace DoctrineMigrations;

use App\Shared\Infrastructure\Migration\AppAbstractMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20230917095133 extends AppAbstractMigration
{
    public function getDescription(): string
    {
        return 'Создает и заполняет dictionary.question';
    }

    public function up(Schema $schema): void
    {
        $multiSql = <<<SQL
            CREATE SEQUENCE "dictionary_question_id_seq" INCREMENT BY 1 MINVALUE 1 START 1;

            CREATE TABLE dictionary.question (
                id INT PRIMARY KEY DEFAULT NEXTVAL('dictionary_question_id_seq'),
                text VARCHAR(512) NOT NULL
            );

            COMMENT ON TABLE dictionary.question IS 'Справочник вопросов из тестов';

            COMMENT ON COLUMN dictionary.question.id IS 'Уникальный идентификатор вопроса';
            COMMENT ON COLUMN dictionary.question.text IS 'Текст вопроса';

        --- 
            INSERT INTO dictionary.question (id, text) VALUES (1, '1 + 1 =');
            INSERT INTO dictionary.question (id, text) VALUES (2, '2 + 2 =');
            INSERT INTO dictionary.question (id, text) VALUES (3, '3 + 3 =');
            INSERT INTO dictionary.question (id, text) VALUES (4, '4 + 4 =');
            INSERT INTO dictionary.question (id, text) VALUES (5, '5 + 5 =');
            INSERT INTO dictionary.question (id, text) VALUES (6, '6 + 6 =');
            INSERT INTO dictionary.question (id, text) VALUES (7, '7 + 7 =');
            INSERT INTO dictionary.question (id, text) VALUES (8, '8 + 8 =');
            INSERT INTO dictionary.question (id, text) VALUES (9, '9 + 9 =');
            INSERT INTO dictionary.question (id, text) VALUES (10, '10 + 10 =');
        SQL;

        $this->addMultiSql($multiSql);
    }
}
