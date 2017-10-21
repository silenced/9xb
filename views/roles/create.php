<form action="<?=$_SERVER['PHP_SELF'];?>/" method="POST" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="enter role name">
    <input name="description" type="text" placeholder="enter role description">
    <input name="controller" type="hidden" value="roles">
    <input name="action" type="hidden" value="store">
    <?=csrf()['input'];?>
    <input type="submit" value="Submit" />
</form>