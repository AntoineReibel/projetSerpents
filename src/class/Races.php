<?php

namespace class;

class Races
{
    public function __construct(
        private $id = null,
        private $table = "races",
    )
    {
    }

    public function selectAll()
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT * FROM $this->table");
    }


    public function get($colonne)
    {
        $sql = new Bdd();
        return $sql->select($this->table, $this->id, $colonne);
    }

}