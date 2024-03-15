<?php

$db = new Database(
    dbhost: DB_HOST,
    dbname: DB_NAME,
    dbuser: DB_USER,
    dbpass: DB_PASS
);

return $db->getConnection();
