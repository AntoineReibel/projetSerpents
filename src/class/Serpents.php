<?php

namespace class;

class Serpents
{
    public function __construct(
        private $id = null,
        private $table = "serpents",
        private $colonnes = ['nomSerpent', 'poids', 'dureeDeVie', 'DateNaissance', 'isMale', 'idRace','isDead']
    )
    {
    }

    public function selectAll()
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT * FROM $this->table INNER JOIN races ON id_races = idRace");
    }

    public function orderBy($colonne, $sens='ASC')
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT * FROM $this->table INNER JOIN races ON id_races = idRace ORDER BY $colonne $sens");
    }


    public function get($colonne)
    {
        $sql = new Bdd();
        return $sql->select($this->table, $this->id, $colonne);
    }

    public function set($colonne, $value): void
    {
        $sql = new Bdd();
        $sql->update($this->table, $this->id, $colonne, $value);
    }

    public function delete(): void
    {
        $sql = new Bdd();
        $sql->delete($this->table, $this->id);
    }

    public function insert($data): void
    {
        $sql = new Bdd();
        $sql->insert($this->table, $this->colonnes, $data);
    }
}