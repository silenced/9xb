<form action="<?=$_SERVER['PHP_SELF'];?>/" method="post">
    <table>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email Address</th>
            <th>Job Role</th>
            <th>Role Description</th>
            <th>Delete</th>
        </tr>
        <?php
        $i=0;
        foreach ($users as $user) {
            ?>
            <tr>
                <td><input type="text" name="people[<?=$i;?>][first_name]" value="<?=$user->first_name;?>" /></td>
                <td><input type="text" name="people[<?=$i;?>][last_name]" value="<?=$user->last_name;?>" /></td>
                <td><input type="email" name="people[<?=$i;?>][email]" value="<?=$user->email;?>" /></td>
                <td>
                    <select name="people[<?=$i;?>][role_id]">
                        <option value="">Select role</option>
                    <?php
                    foreach ($roles as $role) {
                        $selected = '';
                        if ($user->role_id == $role->id) {
                            $selected = 'selected="selected"';
                        }
                        ?>
                        <option value="<?=$role->id;?>" <?=$selected;?>><?=$role->name;?></option>
                        <?php
                    }
                    ?>
                    </select>
                </td>
                <td><input type="text" value="<?=$user->role()->description;?>" readonly/></td>
                <td><input type="hidden" name="people[<?=$i;?>][id]" value="<?=$user->id;?>" /></td>
                <td><input type="checkbox" name="people[<?=$i;?>][delete]" value="1" /></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        <tr>
            <td><input type="text" name="people[<?=$i;?>][first_name]" placeholder="Add new..." /></td>
            <td><input type="text" name="people[<?=$i;?>][last_name]" placeholder="Add new..." /></td>
            <td><input type="email" name="people[<?=$i;?>][email]" placeholder="Add new..." /></td>
            <td>
                <select name="people[<?=$i;?>][role_id]">
                    <option value="">Select role</option>
                <?php
                foreach ($roles as $role) {
                    ?>
                    <option value="<?=$role->id;?>"><?=$role->name;?></option>
                    <?php
                }
                ?>
                </select>
            </td>
            <td><input type="text" readonly/></td>
        </tr>
    </table>
    <input type="hidden" value="users" name="controller" />
    <input type="hidden" value="update_all" name="action" />
    <?=csrf()['input'];?>
    <input type="submit" value="Submit!" />
</form>

<div class="errors" style="color:red;">
<?php
if (isset($_GET['error']) && $_GET['error']) {
    foreach ($_GET['error'] as $error) {
        echo '<p>' . $error . '</p>';
    }
}
?>
</div>