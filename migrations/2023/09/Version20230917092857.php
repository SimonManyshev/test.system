<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace DoctrineMigrations;

use App\Shared\Infrastructure\Migration\AppAbstractMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20230917092857 extends AppAbstractMigration
{
    public function getDescription(): string
    {
        return 'Создает и заполняет dictionary.test';
    }

    public function up(Schema $schema): void
    {
        $multiSql = <<<SQL
            CREATE SEQUENCE "dictionary_test_id_seq" INCREMENT BY 1 MINVALUE 1 START 1;

            CREATE TABLE dictionary.test (
                ID INT PRIMARY KEY
                    DEFAULT NEXTVAL('dictionary_test_id_seq'),
                NAME VARCHAR(512) NOT NULL
            );

            COMMENT ON TABLE dictionary.test IS 'Справочник тестов';

            COMMENT ON COLUMN dictionary.test.id
                IS 'Уникальный идентификатор теста';
            COMMENT ON COLUMN dictionary.test.name IS 'Название теста';

        --- 
            INSERT INTO dictionary.test (id, name)
            VALUES (
                    1,
                    'Арифметический тест'
            );
        SQL;

        $this->addMultiSql($multiSql);
    }
}
