<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php print htmlentities($title) ?>
        </title>
        <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>Create Form</h1>
                <p>ABC is the most popular HTML, CSS, and JS framework for developing
                    responsive, mobile-first projects on the web.</p>
            </div>
            <?php
            if ( $errors ) {
                print '<ul class="errors">';
                foreach ( $errors as $field => $error ) {
                    print '<li>'.htmlentities($error).'</li>';
                }
                print '</ul>';
            }
            ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php if (isset($contact)) echo $contact->name; ?>"/>
                </div>

                <div class="form-group">
                    <label for="name">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php if (isset($contact)) echo $contact->phone; ?>"/>
                </div>

                <div class="form-group">
                    <label for="phone">Email</label><br/>
                    <input type="email" name="email" class="form-control" value="<?php if (isset($contact)) echo $contact->email; ?>" />
                </div>

                <div class="form-group">
                    <label for="phone">Address</label><br/>
                    <textarea name="address" class="form-control" rows="3"><?php if (isset($contact)) echo $contact->address; ?></textarea>
                </div>

                <input type="hidden" name="form-submitted" value="1" />
                <input type="submit" value="Submit" class="btn btn-primary"/>
            </form>
        </div>
    </body>
</html>
