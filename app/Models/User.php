<?php
namespace App\Models;

use Pimple\Container;

class User
{
    private $db;

    public function __construct(Container $container)
    {
        $this->db = $container['db'];
    }

    public function get($id)
    {
        $statement = $this->db->prepare('SELECT * FROM `users` WHERE id=?' );
        $statement->execute([$id]);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}