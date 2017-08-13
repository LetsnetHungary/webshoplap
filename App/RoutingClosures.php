<?

$error = function() {
    require("App/Controllers/Error.php");
    $error = new Error();

    $error->checkCategoryRoute();
};