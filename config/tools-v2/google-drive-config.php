<?php

do {
    // get all credentials file
    $credentials = glob(ROOT_PATH . '/config/tools-v2/credentials/*.json');
    $credential = json_decode(file_get_contents($credentials[0]), true);

    // get one of the credentials file odrer by name
    $service = new \Services\StorageDriver\Google([
        'credentials' => $credential,
    ]);

    // get the space of the drive
    $getSpace = $service->getDriveSpace();

    // if the space is less than 0.2GB, delete the file
    if ($getSpace < 0.2) {
        unlink($credentials);
    }
} while ($getSpace < 0.2);

$storage_driver = $service;