<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Permission Helper
|--------------------------------------------------------------------------
| Handles role-based permission checks for the Admin CMS.
|
| Usage:
|
| if (can('gallery.manage')) {
|     // show menu
| }
|
| requirePermission('gallery.manage');
| // blocks unauthorized direct URL access
|--------------------------------------------------------------------------
*/

require_once __DIR__ . '/Database.php';


/*
|--------------------------------------------------------------------------
| Get Current Admin Role ID
|--------------------------------------------------------------------------
*/

function getCurrentAdminRoleId(): ?int
{
    if (
        !isset($_SESSION['admin']) ||
        !isset($_SESSION['admin']['role'])
    ) {
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Important
    |--------------------------------------------------------------------------
    | The current login session stores role as role_name.
    | Therefore we fetch the actual role_id from the database.
    */

    static $roleId = null;
    static $loaded = false;

    if ($loaded) {
        return $roleId;
    }

    $loaded = true;

    try {

        $database = new Database();

        $pdo = $database->connection();

        $statement = $pdo->prepare("
            SELECT id
            FROM roles
            WHERE name = ?
            LIMIT 1
        ");

        $statement->execute([
            $_SESSION['admin']['role']
        ]);

        $result = $statement->fetch();

        if ($result) {

            $roleId = (int) $result['id'];

        }

    } catch (Throwable $e) {

        $roleId = null;

    }

    return $roleId;
}


/*
|--------------------------------------------------------------------------
| Load Current Admin Permissions
|--------------------------------------------------------------------------
*/

function getAdminPermissions(): array
{
    static $permissions = null;

    if ($permissions !== null) {
        return $permissions;
    }

    $permissions = [];

    $roleId = getCurrentAdminRoleId();

    if ($roleId === null) {
        return $permissions;
    }

    try {

        $database = new Database();

        $pdo = $database->connection();

        $statement = $pdo->prepare("
            SELECT p.name

            FROM role_permissions rp

            INNER JOIN permissions p
                ON p.id = rp.permission_id

            WHERE rp.role_id = ?

            ORDER BY p.name ASC
        ");

        $statement->execute([
            $roleId
        ]);

        $rows = $statement->fetchAll();

        foreach ($rows as $row) {

            $permissions[] = $row['name'];

        }

    } catch (Throwable $e) {

        $permissions = [];

    }

    return $permissions;
}


/*
|--------------------------------------------------------------------------
| Check Permission
|--------------------------------------------------------------------------
|
| Returns:
| true  = permission available
| false = permission unavailable
|
|--------------------------------------------------------------------------
*/

function can(string $permission): bool
{
    if ($permission === '') {
        return false;
    }

    $permissions = getAdminPermissions();

    return in_array(
        $permission,
        $permissions,
        true
    );
}


/*
|--------------------------------------------------------------------------
| Require Permission
|--------------------------------------------------------------------------
|
| Used inside protected admin pages.
|
| Example:
|
| requirePermission('users.manage');
|
|--------------------------------------------------------------------------
*/

function requirePermission(string $permission): void
{
    if (can($permission)) {
        return;
    }

    http_response_code(403);

    echo '<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>403 - Access Denied</title>

<style>

* {
    box-sizing: border-box;
}

body {

    margin: 0;

    min-height: 100vh;

    display: flex;

    align-items: center;

    justify-content: center;

    font-family:
        Arial,
        Helvetica,
        sans-serif;

    background:
        #f5f5f5;

}

.access-denied {

    width: 90%;

    max-width: 500px;

    padding: 45px 35px;

    text-align: center;

    background: #ffffff;

    border-radius: 18px;

    box-shadow:
        0 20px 60px
        rgba(0,0,0,.12);

}

.access-denied h1 {

    margin: 0 0 12px;

    font-size: 64px;

    color: #7B1113;

}

.access-denied h2 {

    margin: 0 0 12px;

    color: #222;

}

.access-denied p {

    margin: 0 0 25px;

    color: #666;

    line-height: 1.6;

}

.access-denied a {

    display: inline-block;

    padding: 12px 24px;

    color: #ffffff;

    background: #7B1113;

    text-decoration: none;

    border-radius: 8px;

}

.access-denied a:hover {

    background: #5f0c0e;

}

</style>

</head>

<body>

<div class="access-denied">

    <h1>403</h1>

    <h2>Access Denied</h2>

    <p>
        You do not have permission to access this page.
    </p>

    <a href="/srs/admin/dashboard">
        Back to Dashboard
    </a>

</div>

</body>
</html>';

    exit;
}