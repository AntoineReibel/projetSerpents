<?php

namespace class;

class Serpents
{
    public function __construct(
        private $id = null,
        private $table = "spectacles",
        private $colonnes = ['nom', 'poids', 'dureeDeVie', 'DateNaissance', 'isMale','isDead', 'idRace']
    )
    {
    }

    public function selectAll()
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT * FROM $this->table");
    }

    public function orderBy($colonne)
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT * FROM $this->table ORDER BY $colonne");
    }

    public function nextEvent()
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT * FROM $this->table WHERE date_evenement > CURDATE() ORDER BY date_evenement LIMIT 1");
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