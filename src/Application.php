<?php

class Application
{
    protected $request;
    protected $router;
    protected $response;
    protected $databaseManager;

    public function __construct()
    {
        $this->router = new Router($this->registerRoutes());
        $this->request = new Request();
        $this->response = new Response();
        $this->databaseManager = new DatabaseManager();
        $this->databaseManager->connect(
            [
                'hostname' => 'db',
                'username' => 'test_user',
                'password' => 'pass',
                'database' => 'test_database',
            ]
        );
    }

    public function run()
    {
        try {
            $params = $this->router->resolve($this->request->getPathInfo());
            if (!$params) {
                throw new HttpNotFoundException();
            }
            $controller = $params['controller'];
            $action = $params['action'];
            $this->runAction($controller, $action);
        } catch (HttpNotFoundException) {
            $this->render404page();
        }

        $this->response->send();
    }

    public function getDatabaseManager()
    {
        return $this->databaseManager;
    }

    public function getRequest()
    {
        return $this->request;
    }


    private function runAction($controllerName, $action)
    {
        $controllerClass = ucfirst($controllerName) . 'Controller';
        if (!class_exists($controllerClass)) {
            throw new HttpNotFoundException();
        }
        $controller = new $controllerClass($this);
        $content = $controller->run($action);
        $this->response->setContent($content);
    }

    private function registerRoutes()
    {
        return [
            '/' => ['controller' => 'shuffle', 'action' => 'index'],
        ];
    }

    private function render404page()
    {
        $this->response->setStatusCode(404, 'Not Found');
        $this->response->setContent(
            <<<EOF
<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>404</title>
</head>
<body>
    <h1>
        404 Page Not Found
    </h1>
</body>
</html>
EOF
        );
    }
}
