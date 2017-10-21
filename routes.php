<?php
// fires the wanted controller and method
function call($controller, $action)
{
    require_once 'controllers/' . $controller . 'Controller.php';

    switch ($controller) {
        case 'users':
            require_once 'models/Role.php';
            require_once 'models/User.php';
            $controller = new UsersController();
            break;
        case 'roles':
            // we need the model to query the database later in the controller
            require_once 'models/Role.php';
            $controller = new RolesController();
            break;
    }

    $controller->{$action}();
}

// we're adding an entry for the new controller and its actions
$controllers = array(
    'users' => ['home', 'error', 'update_all'],
    'roles' => ['index', 'show', 'create', 'store', 'update', 'delete'],
);
// check if the controller and method is defined
if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('users', 'error');
    }
} else {
    call('users', 'error');
}
