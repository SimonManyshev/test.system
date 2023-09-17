<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use function explode;
use function trim;

abstract class AppAbstractMigration extends AbstractMigration
{
    /** @var non-empty-string */
    protected string $multiSqlSeparator = ";";

    /**
     * @param mixed[] $params
     * @param mixed[] $types
     */
    protected function addMultiSql(
        string $multiSql,
        array $params = [],
        array $types = []
    ): void {
        foreach (explode($this->multiSqlSeparator, trim($multiSql)) as $sql) {
            $sql = trim($sql);
            if (empty($sql)) {
                continue;
            }

            $this->addSql($sql, $params, $types);
        }
    }

    public function down(Schema $schema): void
    {
    }
}
