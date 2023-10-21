<?php

namespace class;

use PDO;

class Bdd
{
    private PDO $connection;

    public function __construct(
        string $host = 'localhost',
        string $dbname = 'serpents',
        string $user = 'root',
        string $mdp = '',
    )
    {
        $this->connection = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$mdp");
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function executeRequest($request)
    {
        //securiser
        $startRequest = explode(' ', trim($request));

        if ($startRequest[0] == 'INSERT' || $startRequest[0] == 'UPDATE' || $startRequest[0] == 'SELECT' || $startRequest[0] == 'DELETE') {
            $res = $this->connection->query($request);
            if ($startRequest[0] == 'SELECT') $res = $res->fetchAll();
            if ($startRequest[0] == 'INSERT') $this->connection->lastInsertId();
            return $res;
        } else {
            return false;
        }
    }

    public function select($table, $id, $colonne)
    {

        $idUser = "id_" . $table;
        $request = "SELECT $colonne FROM $table WHERE $idUser = $id";
        $resultat = $this->executeRequest($request);
        return $resultat[0][0];
    }

    public function selectAll($table): array
    {
        $request = "SELECT * FROM $table";
        return $this->executeRequest($request);
    }

    public function delete($table, $id): void
    {
        $idUser = "id_" . $table;
        $request = "DELETE FROM $table WHERE $idUser = $id";
        $this->executeRequest($request);
    }

    public function update($table, $id, $colonne, $nouvelleValeur): void
    {
        $nouvelleValeur = addslashes($nouvelleValeur);
        $idTable = "id_" . $table;
        $request = "UPDATE $table SET $colonne = '$nouvelleValeur' WHERE $idTable = $id";
        $this->executeRequest($request);
    }

    public function insert($table, $colonnes, $data): void
    {
        foreach ($data as &$donneeEchapee) {
            $donneeEchapee = addslashes($donneeEchapee);
        }
        $valeursColonnes = implode(", ", $colonnes);
        $valeursData = "'" . implode("','", $data) . "'";
        $request = "INSERT INTO $table ($valeursColonnes) VALUES ($valeursData)";
        $this->executeRequest($request);
    }
}