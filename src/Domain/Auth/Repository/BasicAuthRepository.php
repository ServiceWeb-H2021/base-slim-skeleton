<?php

namespace App\Domain\Auth\Repository;

use PDO;

/**
 * Repository.
 */
class BasicAuthRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Select user hashed da
     * 
     * @param string $da The da to select
     *
     * @return bool true if the token is valid
     */
    public function selectHashedDa($da): string
    {
        $params = ["da" => $da];

        $sql = "SELECT da FROM users WHERE da = :da";

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $hashedDa = $result[0]['da'] ?? ''; 

        return $hashedDa;
    }
}

