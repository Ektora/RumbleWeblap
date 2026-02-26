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

        public function getMini(int $id): Array{
        $stmt = $this->pdo->prepare("SELECT * FROM minis Where id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function addMini(Array $mini): int{
        $stmt = $this->pdo->prepare(
            "Insert Into minis (name,cost,mini_type,main_family,second_family,description,leaderAbilityName,leaderAbilityDescription,leaderFunnyDescription)
            Values (:name,:cost,:mini_type,:main_family,:second_family,:description,:leaderAbilityName,:leaderAbilityDescription,:leaderFunnyDescription)");
        $stmt->execute([
            ':name' => (string) $mini['name'],
            ':cost' => (int) $mini['cost'],
            ':mini_type' => (string) $mini['mini_type'],
            ':main_family' => (string) $mini['main_family'],
            ':second_family' => (string) $mini['second_family'] ?? null,
            ':description' => (string) $mini['description'] ?? null,
            ':leaderAbilityName' => (string) $mini['leaderAbilityName'] ?? null,
            ':leaderAbilityDescription' => (string) $mini['leaderAbilityDescription'] ?? null,
            ':leaderFunnyDescription' => (string) $mini['leaderFunnyDescription'] ?? null
            ]);
        return (int)$this->pdo->lastInsertId();
         
    }

    public function updateMini(Array $mini) : int{
        $stmt = $this->pdo->prepare(
            "update minis set 
                name=:name,
                cost=:cost,
                mini_type=:mini_type,
                main_family=:main_family,
                second_family=:second_family,
                description=:description,
                leaderAbilityName=:leaderAbilityName,
                leaderAbilityDescription=:leaderAbilityDescription,
                leaderFunnyDescription=:leaderFunnyDescription
            where
                id=:id
            ");
        $stmt->execute([
            ':name' => (string) $mini['name'],
            ':cost' => (int) $mini['cost'],
            ':mini_type' => (string) $mini['mini_type'],
            ':main_family' => (string) $mini['main_family'],
            ':second_family' => (string) $mini['second_family'] ?? null,
            ':description' => (string) $mini['description'] ?? null,
            ':leaderAbilityName' => (string) $mini['leaderAbilityName'] ?? null,
            ':leaderAbilityDescription' => (string) $mini['leaderAbilityDescription'] ?? null,
            ':leaderFunnyDescription' => (string) $mini['leaderFunnyDescription'] ?? null,
            ':id' => (int) $mini['id']
            ]);
        return (int) $mini['id'];
    }

    public function deleteMini(int $id) : bool{
        $stmt = $this->pdo->prepare("delete from minis where id = :id");
        return $stmt->execute([':id' => $id]);
    }

}



?>