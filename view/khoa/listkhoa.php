<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Khoa</title>
        <style type="text/css">
            table.contacts {
                width: 100%;
            }

            table.contacts thead {
                background-color: #eee;
                text-align: left;
            }

            table.contacts thead th {
                border: solid 1px #fff;
                padding: 3px;
            }

            table.contacts tbody td {
                border: solid 1px #eee;
                padding: 3px;
            }

            a, a:hover, a:active, a:visited {
                color: blue;
                text-decoration: underline;
            }
        </style>
        <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div><a href="index.php?op=new" class="btn btn-info">Add new</a></div>
            <table class="contacts" border="0" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th><a href="?orderby=name">Name</a></th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $item): ?>
                    <tr>
                        <td><a href="index.php?op=show&id=<?php print $item->id; ?>"><?php print $item->name; ?></a></td>
                        <td>
                            <a href="index.php?op=edit&id=<?php print $item->id; ?>" class="btn btn-info">edit</a>
                            <a href="index.php?op=delete&id=<?php print $item->id; ?>" class="btn btn-danger" onclick="return checkDel()">delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
    <!--check delete-->
    <script>
        function checkDel()
        {
            return confirm("Are you want delete?");
        }
    </script>

</html>
