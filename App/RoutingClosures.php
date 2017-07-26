<?

$fuckRouting = function () {
    $routes = $_GET['url'];    $routes = rtrim($routes, '/');    $routes = explode('/', $routes);
    if(isset($routes[1]) && !empty($routes[1])) {
        $fuckid = $routes[1];
        require('App/Controllers/Category.php');
        $controller = new Category($fuckid);
    }
    else {
        require('App/Controllers/Index.php');
        $controller = new Index();
    }
};