<?php include_once 'include/header.php';?>
<div class="container">
    <div><a href="index.php?op=new" class="btn btn-info">Add new contact</a></div>
    <table class="contacts" border="0" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><a href="?orderby=name">Name</a></th>
            <th><a href="?orderby=phone">Phone</a></th>
            <th><a href="?orderby=email">Email</a></th>
            <th><a href="?orderby=address">Address</a></th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><a href="index.php?op=show&id=<?php print $contact->id; ?>"><?php print htmlentities($contact->name); ?></a></td>
                <td><?php print htmlentities($contact->phone); ?></td>
                <td><?php print htmlentities($contact->email); ?></td>
                <td><?php print htmlentities($contact->address); ?></td>
                <td>
                    <a href="index.php?op=edit&id=<?php print $contact->id; ?>" class="btn btn-info">edit</a>
                    <a href="index.php?op=delete&id=<?php print $contact->id; ?>" class="btn btn-danger" onclick="return checkDel()">delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include_once 'include/footer.php';?>
