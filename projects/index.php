<?php

header("Location: http://" . $_SERVER['SERVER_NAME'] . ($_SERVER['SERVER_PORT'] != 80 ? ":" . $_SERVER['SERVER_PORT'] : "") . "/_projects/");
exit;
