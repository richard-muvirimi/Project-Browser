<!DOCTYPE html>
<html>
    <title>Applets</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= assets_url("css/w3.css") ?>">
    <link rel="stylesheet" href="<?= assets_url("css/project.css") ?>">

    <!-- https://github.com/simonwhitaker/github-fork-ribbon-css -->
    <link rel="stylesheet" href="<?= assets_url("css/gh-fork-ribbon.min.css") ?>">

    <script src="<?= assets_url("js/jquery-3.6.0.min.js") ?>"></script>
    <script src="<?= assets_url("js/project.js") ?>"></script>

    <meta property="og:image" content="<?= base_url("public/screenshot.png") ?>">
    <meta property="og:url" content="<?= base_url() ?>">

    <meta name="description" content="<?= lang("Projects.meta.description") ?>" />
    <meta name="keywords" content="Project, PHP, Project List, Folder Browser">
    <meta name="author" content="Richard Muvirmi">

    <meta property="og:title" content="ZimRate">
    <meta property="og:description" content="<?= lang("Projects.meta.description") ?>">

    <body class="w3-light-grey w3-content" style="max-width:1600px">

        <!-- Fork -->
        <a class="github-fork-ribbon" href="https://github.com/tygalive/Project-Browser"
            data-ribbon="<?= lang("Projects.site.fork") ?>" title="Fork me on GitHub"
            target=" _blank"><?= lang("Projects.site.fork") ?></a>

        <!-- Header -->
        <header class="w3-panel w3-center w3-opacity w3-padding-64">
            <h1 class="w3-xlarge"><?= lang("Projects.site.title") ?></h1>
            <p><?= lang("Projects.site.author") ?></p>
            <h1>
                <a href="https://tyganeutronics.com" target="_blank">Richard Muvirimi</a>
            </h1>

            <?= view("partial/navigation") ?>
        </header>

        <!-- !PAGE CONTENT! -->
        <div id="projects" class="w3-main w3-container">

            <!-- Pagination -->
            <?= view("partial/pagination", compact("page", "chunk", "total")) ?>
            <?php $columns = 3; ?>
            <div class="project-container" style="columns: <?= $columns ?> 200px;">
                <?php
            for ($i = 0; $i < count($projects); $i++) {
                echo view("partial/project", array("project" => $projects[$i]));
            }
            ?>
            </div>

            <!-- Pagination -->
            <?= view("partial/pagination", compact("page", "chunk", "total")) ?>

            <!-- End page content -->
        </div>

        <!-- Footer -->
        <footer id="contact" class="w3-container w3-padding-64 w3-light-grey w3-center w3-opacity">
            <?= view("partial/navigation") ?>
            <h3>
                <a href="https://tyganeutronics.com?ref" target="_blank">Richard Muvirimi</a>
            </h3>
        </footer>

</html>