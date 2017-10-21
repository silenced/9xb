<form action="<?=SITE_URL;?>/" method="POST" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="enter role name">
    <input name="description" type="text" placeholder="enter role description">
    <input name="controller" type="hidden" value="roles">
    <input name="action" type="hidden" value="store">
    <input type="submit" value="Submit" />
</form>