<?php
class Role
{
    // we define 3 attributes
    // they are public so that we can access them using $role->name directly
    public $id;
    public $name;
    public $description;

    public function __construct($id, $name, $description)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
    }

    /**
     * all()
     *
     * returns an array of all role objects
     *
     * @return array
     */
    public static function all()
    {
        $list = [];
        $db   = Db::getInstance();
        $req  = $db->query('SELECT * FROM Roles');

        // we create a list of Role objects from the database results
        foreach ($req->fetchAll() as $role) {
            $list[] = new Role($role['id'], $role['name'], $role['description']);
        }

        return $list;
    }

    /**
     * find()
     *
     * finds a role by its id and returns its object
     *
     * @param (int) ($id) id of the role needed
     * @return object
     */
    public static function find($id)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id  = intval($id);
        $req = $db->prepare('SELECT * FROM Roles WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $role = $req->fetch();

        return new Role($role['id'], $role['name'], $role['description']);
    }

    /**
     * create()
     *
     * stores a new role in the database and returns its id
     *
     * @param (array) ($params) array of all the parameters needed to create the role
     * @return int
     */
    public static function create($params)
    {
        $db   = Db::getInstance();
        $stmt = $db->prepare("INSERT INTO Roles (name, description) VALUES (:name, :description)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);

        $name        = $params['name'];
        $description = $params['description'];
        $stmt->execute();

        return $db->lastInsertId();
    }

    /**
     * update()
     *
     * updates an existing role in the database and returns its id
     *
     * @param (array) ($params) array of all the parameters needed to update the role
     * @return int
     */
    public static function update($params)
    {

    }

    /**
     * delete()
     *
     * deletes an existing role from the database
     *
     * @param (int) ($id) if of the role to be deleted
     * @return void
     */
    public static function delete($id)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id  = intval($id);
        $req = $db->prepare('DELETE FROM Roles WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
    }

    /**
     * users()
     *
     * returns an array of the user objects that are associated with the instanciated role
     *
     * @return array
     */
    public function users()
    {

    }
}
