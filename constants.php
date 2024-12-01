<?php

define("BASE_URL", $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR);
define("PHOTO_UPLOADS", BASE_URL . "assets/public/uploads/");
define("MAX_FILESIZE", 1024 * 1024);
define("FILE_EXTENSIONS", ["image/jpeg", "image/jpg", "image/png"]);