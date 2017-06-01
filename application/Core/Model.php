<?php

namespace Mini\Core;

use PDO;

class Model
{
    /**
     * @var null Database Connection
     */
    protected $db = null;
    protected $conexion = "aca00";

    protected $DB_CONFIG = [
        "aca00" => [
            'DB_TYPE' => 'oci',
            'DB_NAME' => 'rac-scan.usbmed.edu.co:1521/sicpro',
            'DB_USER' => 'aca00',
            'DB_PASS' => 'rpj5asicb',
            'DB_CHARSET' => 'utf8'
        ],
        "con00" => [
            'DB_TYPE' => 'oci',
            'DB_NAME' => 'rac-scan.usbmed.edu.co:1521/sicpro',
            'DB_USER' => 'con00',
            'DB_PASS' => 'tybFisiR12',
            'DB_CHARSET' => 'utf8'
        ],
    ];

    /**
     * Whenever model is created, open a database connection.
     */
    function __construct()
    {
        try {
            self::openDatabaseConnection();
        } catch (\PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/

        $this->db = new PDO($this->DB_CONFIG[$this->conexion]["DB_TYPE"] . ':dbname=//' . $this->DB_CONFIG[$this->conexion]["DB_NAME"] . ';charset=' . $this->DB_CONFIG[$this->conexion]["DB_CHARSET"], $this->DB_CONFIG[$this->conexion]["DB_USER"], $this->DB_CONFIG[$this->conexion]["DB_PASS"], $options);
    }
}
