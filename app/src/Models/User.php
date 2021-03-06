<?php
namespace App\Models;

use Pimple\Container;

class User
{
    private $db;

    public function __construct(Container $container)
    {
        $this->db = $container['db'];
        $this->events = $container['events'];
    }

    public function get($id)
    {
        $statement = $this->db->prepare('SELECT * FROM `users` WHERE id=?' );
        $statement->execute([$id]);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function create (array $data)
    {
        $this->events->trigger('creating.users', null, $data);
        // add to database
        $this->events->trigger('created.users', null, $data);
    }
}
