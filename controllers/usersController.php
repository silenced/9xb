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
        csrfCheck(); // helpers.php
        $all_users  = User::all();
        $role_id    = test_input(filter_var($args['role_id'], FILTER_SANITIZE_NUMBER_INT));
        $role       = Role::find($role_id);
        $role_users = $role->users();

        if (count($all_users) >= 10) {
            return;
        }

        if (count($role_users) >= 4) {
            return;
        }

        // Sanitize strings - use test helper functions
        if (!test_name($args['first_name'])) {
            $this->errors['first_name'] = 'Only letters and white space allowed';
            return;
        }
        if (!test_name($args['last_name'])) {
            $this->errors['last_name'] = 'Only letters and white space allowed';
            return;
        }
        if (!test_email($args['email'])) {
            $this->errors['email'] = 'Invalid email format';
            return;
        }

        $params = array(
            'first_name' => test_name($args['first_name']),
            'last_name'  => test_name($args['last_name']),
            'email'      => test_email($args['email']),
            'role_id'    => $role_id,
        );
        $user = User::create($params);
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
        csrfCheck(); // helpers.php
        $all_users  = User::all();
        $role_id    = test_input(filter_var($args['role_id'], FILTER_SANITIZE_NUMBER_INT));
        $role       = Role::find($role_id);
        $role_users = $role->users();

        if (count($all_users) >= 10) {
            return;
        }

        if (count($role_users) >= 4) {
            return;
        }

        // Sanitize strings - use test helper functions
        if (!test_name($args['first_name'])) {
            $this->errors['first_name'] = 'Only letters and white space allowed.';
            return;
        }
        if (!test_name($args['last_name'])) {
            $this->errors['last_name'] = 'Only letters and white space allowed.';
            return;
        }
        if (!test_email($args['email'])) {
            $this->errors['email'] = 'Invalid email format.';
            return;
        }

        $params = array(
            'id'         => test_input(filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT)),
            'first_name' => test_name($args['first_name']),
            'last_name'  => test_name($args['last_name']),
            'email'      => test_email($args['email']),
            'role_id'    => $role_id,
        );
        $user = User::update($params);
    }

    /**
     * delete()
     *
     * calls the User::delete() method to delete an existing user
     *
     * @return void
     */
    public function delete($id)
    {
        csrfCheck(); // helpers.php
        $id = intval($id);
        User::find($id)->delete();
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
        $new_user = true; // flag to check later on if all fields are submitted
        // check the number of users per role bofore the query loop for better data handling of the multi-update form
        $roles_count = [];
        $role_full   = false;
        foreach ($_POST['people'] as $user) {
            if (isset($user['role_id'])) {
                $roles_count[$user['role_id']]++;
                if ($roles_count[$user['role_id']] > 4) {
                    $role_full = true;
                }
            }
        }

        if ($role_full || count($_POST['people']) > 10) {
            $this->errors['max_role_users'] = 'The users cannot be more than 10 and the maximum users assigned to a role cannot be more than 4.';
        }

        if (empty($this->errors)) {
            $i = 0;
            foreach ($_POST['people'] as $user) {
                if (isset($user['delete']) && $user['delete'] == 1) {
                    $this->delete($user['id']);
                } elseif (!isset($user['delete']) || !$user['delete']) {
                    // if all new user fields are empty then don't 
                    if (empty($user['first_name']) && empty($user['last_name']) && empty($user['email']) && empty($user['role_id'])) {
                        $new_user = false; // none of the fields was submitted so we assume that there is not new user request
                    } elseif (empty($user['first_name']) || empty($user['last_name']) || empty($user['email']) || empty($user['role_id'])) {
                        $this->errors[$i]['empty_fields'] = 'All fields are mandatory.';
                    }

                    // check if the current record has error
                    if (empty($this->errors[$i])) {
                        if (empty($user['id']) && $new_user) {
                            $this->store($user);
                        } elseif (!empty($user['id'])) {
                            $this->update($user);
                        }
                    }
                }
                $i++;
            }
        }

        // get all the values of errors array into the query string
        $errors_string = '';
        if (!empty($this->errors)) {
            array_walk_recursive($this->errors, function ($value, $key) use (&$errors_string) {
                $errors_string .= '&error[]=' . $value;
            });
        }

        header('Location: ' . SITE_URL . '/?controller=users&action=home' . $errors_string);
        die;
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
