<?php

namespace class;

class Serpents
{
    public function __construct(
        private $id = null,
        private $table = "serpents",
        private $colonnes = ['nomSerpent', 'poids', 'dureeDeVie', 'DateNaissance', 'isMale', 'idRace']
    )
    {
    }

    public function selectAll()
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT * FROM $this->table INNER JOIN races ON id_races = idRace");
    }

    public function countAliveSerpent()
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT COUNT(*) AS totalSerpents FROM serpents WHERE isDead = 0 ");
    }

    public function paginate($colonne, $sens, $position, $nombreParPage, $isDead = 0, $inLoveRoom = 0)
    {
        $sql = new Bdd();
        return $sql->executeRequest("SELECT * FROM $this->table INNER JOIN races ON id_races = idRace WHERE isDead = $isDead AND inLoveRoom = $inLoveRoom ORDER BY $colonne $sens  LIMIT $position, $nombreParPage");
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

    private function delete(): void
    {
        $sql = new Bdd();
        $sql->delete($this->table, $this->id);
    }

    public function insert($data): void
    {
        $sql = new Bdd();
        $sql->insert($this->table, $this->colonnes, $data);
    }

    public function create15(): void
    {
        $sql = new Bdd();
        for ($i = 0; $i < 15; $i++) {
            $sql->insert($this->table, $this->colonnes, [$this->randomName(),rand(3,10),dateMort(), dateActuelle(),rand(0,1),rand(1,5)]);
        }
    }

    private function randomName() : string
    {
        $names = ['Zephyr', 'Aurelia', 'Nyx', 'Ophelia', 'Lazarus', 'Circe', 'Elio', 'Astrid', 'Dahlia', 'Odin', 'Isolde', 'Cyrus', 'Aurora', 'Elysium', 'Jasper', 'Thalia', 'Kairos', 'Lorelei', 'Zara', 'Lysander', 'Selene', 'Leander', 'Evelina', 'Drake', 'Aurelian', 'Calypso', 'Soren', 'Daphne', 'Ezra', 'Cosima', 'Cassius', 'Olympia', 'Zora', 'Orpheus', 'Althea', 'Zephyrine', 'Helios', 'Thora', 'Cassiopeia', 'Zephyrus', 'Nephele', 'Aurelius', 'Ariadne', 'Calix', 'Leandra', 'Elysia', 'Zephyra', 'Cassian', 'Eulalia', 'Oleander', 'Zelda', 'Evanora', 'Cedric', 'Darius', 'Zenobia', 'Xander', 'Octavia', 'Cleopatra', 'Ezio', 'Aurelio', 'Zahir', 'Leda', 'Dante', 'Elara', 'Astraea', 'Ione', 'Saffron', 'Artemis', 'Cleopatra', 'Electra', 'Helena', 'Icarus', 'Juniper', 'Luna', 'Morpheus', 'Nero', 'Olympus', 'Pandora', 'Phoebe', 'Rhea', 'Solomon', 'Triton', 'Ulysses', 'Vesper', 'Xena', 'Zelda', 'Apollo', 'Athena', 'Boreas', 'Calliope', 'Dionysus', 'Eos', 'Hermes', 'Iris', 'Juno', 'Kratos', 'Lilith', 'Mars', 'Nike', 'Orion', 'Persephone', 'Raphael', 'Sappho', 'Triton', 'Urania', 'Venus', 'Xerxes', 'Zephyrus'];

        shuffle($names);
        return $names[0];
    }
}