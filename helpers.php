<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function test_name($name)
{
    $name = test_input($name);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        return false;
    }
    return $name;
}

function test_email($email)
{
    $email = test_input($email);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return $email;
}

function csrf()
{
    // create a token to check if the request is fro the same session
    $csrfToken = md5(uniqid(mt_rand(), true));

    $_SESSION['csrfToken'] = $csrfToken;
    $res['input'] = '<input type="hidden" name="csrfKey" value="' . $csrfToken . '" />';
    $res['token'] = $csrfToken;
    return $res;
}

function csrfCheck()
{
    if (empty($_POST['csrfKey']) || $_POST['csrfKey'] != $_SESSION['csrfToken']) {
        die("Unauthorized source!");
    }
}

function csrfCheckGet()
{
    if (!isset($_GET['token']) || empty($_GET['token']) || $_GET['token'] != $_SESSION['csrfToken']) {
        die("Unauthorized source!");
    }
}