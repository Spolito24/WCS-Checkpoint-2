<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';
    public const TABLE2 = 'accessory';

    public function addCupcake(array $cupcake)
    {
        $query = "INSERT INTO " . self::TABLE . " (name, color1, color2, color3, accessory_id)
        VALUES (:name, :color1, :color2, :color3, :accessory);";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $cupcake['name'], PDO::PARAM_STR);
        $statement->bindValue(':color1', $cupcake['color1'], PDO::PARAM_STR);
        $statement->bindValue(':color2', $cupcake['color2'], PDO::PARAM_STR);
        $statement->bindValue(':color3', $cupcake['color3'], PDO::PARAM_STR);
        $statement->bindValue(':accessory', $cupcake['accessory'], PDO::PARAM_INT);

        $statement->execute();
    }

    public function selectCupcake()
    {
        $query = 'SELECT c.id, c.name, c.color1, c.color2, c.color3, a.url 
        FROM ' . self::TABLE . ' as c
        INNER JOIN ' . self::TABLE2 . ' a on c.accessory_id=a.id
        ORDER BY id DESC;';

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectOneCupcake(int $id)
    {
        $statement = $this->pdo->prepare('SELECT c.id, c.name, c.color1, c.color2, c.color3, a.url 
        FROM ' . self::TABLE . ' as c
        INNER JOIN ' . self::TABLE2 . ' a on c.accessory_id=a.id
        WHERE c.id = :cupcake_id
        ORDER BY id DESC');
        $statement->bindValue(':cupcake_id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
