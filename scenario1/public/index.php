<?php  

session_start();

require(__DIR__ . '/../config/database.php');
require(__DIR__ . '/../config/router.php');

// Auto load classes
spl_autoload_register(function ($class_name) {
    include __DIR__ . '/../lib/' . $class_name . '.php';
});

return (new App($config))->bootstrap();

?>

