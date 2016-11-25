<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php print $contact->name; ?></title>
        <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h1><?php print $contact->name; ?></h1>
            <div>
                <span class="label">Phone:</span>
                <?php print $contact->phone; ?>
            </div>
            <div>
                <span class="label">Email:</span>
                <?php print $contact->email; ?>
            </div>
            <div>
                <span class="label">Address:</span>
                <?php print $contact->address; ?>
            </div>
        </div>
    </body>
</html>
