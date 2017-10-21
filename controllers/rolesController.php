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

    }
}
