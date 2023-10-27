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

    public function countAliveSerpent() {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT COUNT(*) AS totalSerpents FROM serpents WHERE isDead = 0 ");
    }

    public function paginate($colonne, $sens, $position, $nombreParPage, $isDead = 0 )
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT * FROM $this->table INNER JOIN races ON id_races = idRace WHERE isDead = $isDead ORDER BY $colonne $sens  LIMIT $position, $nombreParPage");
    }

    public function orderBy($colonne, $sens)
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