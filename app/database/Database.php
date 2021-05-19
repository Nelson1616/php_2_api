<?php

namespace App\database;

use PDO;
use PDOException;

class Database
{
    private $conection;

    public $table = '';

    public $fillable = [];

    public function __construct()
    {
        $db_type = 'mysql';
        $db_host = 'localhost';
        $db_name = 'db_php_2_api';
        $db_user = 'root';
        $db_password = '';
        $dsn = $db_type . ':host=' . $db_host . ';dbname=' . $db_name;
        try
        {
            $this->conection = new PDO($dsn, $db_user, $db_password);
        }
        catch(PDOException $e)
        {
            return $e;
        }
    }

    public function create_table($query)
    {
        return $this->conection->exec($query);
    }

    public function findAll()
    {
        $query = 
        '
        SELECT * FROM ' . $this->table . '
        ';

        $stmt = $this->conection->query($query);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function store($data)
    {
        $stringFilles = '';
        $stringValues = '';

        $filles = [];
        foreach($this->fillable as $key)
        {
              if(array_key_exists($key, $data))
              {
                $filles[$key] = $data[$key];
                $stringFilles .= $key . ',';
                $stringValues .= '"' . $data[$key] . '"' . ',';
              }
        }
        $stringFilles = substr($stringFilles, 0, -1);
        $stringValues = substr($stringValues, 0, -1);

        $query = 
        '
        INSERT INTO ' . $this->table . ' (' . $stringFilles . ')
        VALUES (' . $stringValues . ')
        ';

        return $this->conection->exec($query);   
    }

    public function update($id, $data)
    {
        $stringValue = '';

        $filles = [];
        foreach($this->fillable as $key)
        {
              if(array_key_exists($key, $data))
              {
                $filles[$key] = $data[$key];
                $stringValue .= $key . '="' . $data[$key] . '",';
              }
        }
        $stringValue = substr($stringValue, 0, -1);

        $query = 
        '
        UPDATE ' . $this->table . ' 
        SET ' . $stringValue . ' 
        WHERE id = ' . $id . '
        ';

        return $this->conection->exec($query);   
    }

    public function delete($id)
    {
        $query = 
        '
        DELETE FROM ' . $this->table . '
        WHERE id = ' . $id . '
        ';

        return $this->conection->exec($query); 
        
    }

    public function find($id)
    {
        $query = 
        '
        SELECT * FROM ' . $this->table . '
        WHERE id = ' . $id . '
        ';

        $stmt = $this->conection->query($query);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
