<?php
declare(strict_types=1);

final class MiniRepository{

    public function __construct(private PDO $pdo)
    {
        
    }

    public function getAll() : Array{
        $rows = $this->pdo->query("SELECT * FROM minis ORDER BY id")->fetchAll();
        return $rows ?? [];
    }

    public function createMini(){

    }

}

?>