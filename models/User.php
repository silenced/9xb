<?php
class User
{
    // we define 5 attributes
    // they are public so that we can access them using $role->name directly
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $role_id;

    public function __construct($id, $first_name, $last_name, $email, $role_id)
    {
        $this->id         = $id;
        $this->first_name = $first_name;
        $this->last_name  = $last_name;
        $this->email      = $email;
        $this->role_id    = $role_id;
    }

    /**
     * all()
     *
     * returns an array of all user objects
     *
     * @return array
     */
    public static function all()
    {
        $list = [];
        $db   = Db::getInstance();
        $req  = $db->query('SELECT * FROM Users');

        // we create a list of User objects from the database results
        foreach ($req->fetchAll() as $user) {
            $list[] = new User($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['role_id']);
        }

        return $list;
    }

    /**
     * find()
     *
     * finds a user by its id and returns its object
     *
     * @param (int) ($id) id of the user needed
     * @return object
     */
    public static function find($id)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id  = intval($id);
        $req = $db->prepare('SELECT * FROM Users WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $user = $req->fetch();

        return new User($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['role_id']);
    }

    /**
     * create()
     *
     * stores a new user in the database and returns its id
     *
     * @param (array) ($params) array of all the parameters needed to create the user
     * @return int
     */
    public static function create($params)
    {
        $db   = Db::getInstance();
        $stmt = $db->prepare("INSERT INTO Users (first_name, last_name, email, role_id) VALUES (:first_name, :last_name, :email, :role_id)");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role_id', $role_id);

        $first_name = $params['first_name'];
        $last_name  = $params['last_name'];
        $email      = $params['email'];
        $role_id    = $params['role_id'];
        $stmt->execute();

        return $db->lastInsertId();
    }

    /**
     * update()
     *
     * updates an existing user in the database and returns its id
     *
     * @param (array) ($params) array of all the parameters needed to update the user
     * @return int
     */
    public static function update($params)
    {
        $db   = Db::getInstance();
        $stmt = $db->prepare("UPDATE Users SET first_name=:first_name, last_name=:last_name, email=:email, role_id=:role_id WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role_id', $role_id);

        $id         = $params['id'];
        $first_name = $params['first_name'];
        $last_name  = $params['last_name'];
        $email      = $params['email'];
        $role_id    = $params['role_id'];
        $stmt->execute();

        return $db->lastInsertId();
    }

    /**
     * delete()
     *
     * deletes an existing user from the database
     *
     * @param (int) ($id) if of the user to be deleted
     * @return void
     */
    public function delete()
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id  = intval($this->id);
        $req = $db->prepare('DELETE FROM Users WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
    }

    /**
     * role()
     *
     * returns an object of the role associated to the instanciated user
     *
     * @return array
     */
    public function role()
    {
        $role = Role::find($this->role_id);
        return $role;
    }
}
