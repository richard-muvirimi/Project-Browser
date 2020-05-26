<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Projects</title>
        <link rel="stylesheet" type="text/css" href=<?php
        echo '"' . base_url("assets/css/projects.css") . '"';
        ?> >

        <script src=<?php
              echo '"' . base_url("assets/js/projects.js") . '"';
        ?>></script>
    </head>
    <body onload="prepareTable()">

        <div id="container">
            <h1>My Projects!</h1>

            <div id="body">
                <?php
                echo $table;
                ?>
            </div>

            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>

    </body>
</html>