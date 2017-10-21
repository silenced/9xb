<p>Here is a list of all roles:</p>

<?php
$csrf = csrf();
$csrf_input = $csrf['input'];
$csrf_token = $csrf['token'];
foreach ($roles as $role) {?>
    <form method="post" action="<?=SITE_URL;?>/" enctype="multipart/form-data">
        <input type="hidden" value="update" name="action" />
        <input type="hidden" value="roles" name="controller" />
        <input type="hidden" value="<?php echo $role->id; ?>" name="id" />
        <input type="text" value="<?php echo $role->name; ?>" name="name" />
        <input type="text" value="<?php echo $role->description; ?>" name="description" />
        <?=$csrf_input;?>
        <input type="submit" value="Update" />
        <a href='?controller=roles&action=delete&id=<?=$role->id;?>&token=<?=$csrf_token;?>'>Delete</a>
    </form>
<?php }?>

<a href="<?=SITE_URL;?>/?controller=roles&action=create">Create new role</a>