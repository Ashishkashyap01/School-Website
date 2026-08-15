<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';

if (!isset($GLOBALS['settings'])) {

    $database = new Database();

    $pdo = $database->connection();

    $statement = $pdo->query("
        SELECT *
        FROM settings
        LIMIT 1
    ");

    $settings = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$settings) {

        $settings = [

            'school_name' => 'Sone Rising School',
            'tagline'      => '',
            'logo'         => '',
            'favicon'      => '',
            'email'        => '',
            'phone'        => '',
            'address'      => '',
            'facebook'     => '',
            'instagram'    => '',
            'youtube'      => '',
            'twitter'      => '',
            'theme_color'  => '#7B1113'

        ];

    }

    $GLOBALS['settings'] = $settings;

}

$settings = $GLOBALS['settings'];