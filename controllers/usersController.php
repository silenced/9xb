<?php
class UsersController
{

    public $errors = [];

    /**
     * home()
     *
     * used from the route to display the right template with the needed objects
     *
     * @return void
     */
    public function home()
    {
        $roles  = Role::all();
        $users  = User::all();
        $errors = $this->errors;
        require_once 'views/users/home.php';
    }

    /**
     * store()
     *
     * calls the User::create() method to insert a new user
     *
     * @param (array) ($args) array of all the parameters needed to insert the user
     * @return void
     */
    public function store($args)
    {

    }

    /**
     * update()
     *
     * calls the User::update() method to update existing users
     *
     * @param (array) ($args) array of all the parameters needed to update the user
     * @return void
     */
    public function update($args)
    {

    }

    /**
     * update_all()
     *
     * iterates the store or update method for each valid
     * record of the request if no errors
     *
     *
     * @return redirection
     */
    public function update_all()
    {

    }

    /**
     * error()
     *
     * used by routes to display the error template
     *
     * @return void
     */
    public function error()
    {
        require_once 'views/users/error.php';
    }
}
