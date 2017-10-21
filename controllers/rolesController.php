<?php
class RolesController
{
    /**
     * index()
     *
     * used by routes to display the roles list template
     *
     * @return void
     */
    public function index()
    {
        // we store all the roles in a variable
        $roles = Role::all();
        require_once 'views/roles/index.php';
    }

    /**
     * show()
     *
     * used by routes to display the single role template
     *
     * @return void
     */
    public function show()
    {
        // we expect a url of form ?controller=roles&action=show&id=x
        // without an id we just redirect to the error page as we need the role id to find it in the database
        if (!isset($_GET['id'])) {
            return call('users', 'error');
        }

        // we use the given id to get the right role
        $role = Role::find($_GET['id']);
        require_once 'views/roles/show.php';
    }

    /**
     * create()
     *
     * used by routes to display the create role template
     *
     * @return void
     */
    public function create()
    {
        require_once 'views/roles/create.php';
    }

    /**
     * store()
     *
     * calls the Role::create() method to insert a new role
     *
     * @return redriection
     */
    public function store()
    {
        $name = test_name($_REQUEST['name']);
        $description = test_input($_REQUEST['description']);
        if ($name) {
            $params = array(
                'name'        => $name,
                'description' => $description,
            );
            $role = Role::create($params);
        }
        header('Location: ' . SITE_URL . '/?controller=roles&action=index');
        die;
    }

    /**
     * update()
     *
     * calls the Role::update() method to update an existing role
     *
     * @return redriection
     */
    public function update()
    {
        $id          = intval($_REQUEST['id']);
        $name        = test_name($_REQUEST['name']);
        $description = test_input($_REQUEST['description']);

        if ($name) {
            $params = array(
                'id'          => $id,
                'name'        => $name,
                'description' => $description,
            );
            $role = Role::update($params);
        }
        header('Location: ' . SITE_URL . '/?controller=roles&action=index');
        die;
    }

    /**
     * delete()
     *
     * calls the Role::delete() method to delete an existing role
     *
     * @return redriection
     */
    public function delete()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
        }
        $role = Role::delete($id);
        header('Location: ' . SITE_URL . '/?controller=roles&action=index');
        die;
    }
}
