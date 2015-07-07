<?php namespace TrigaBackend\Breadcrumbs;

use Illuminate\Routing\Router;
use TrigaBackend\Contract\RenderInterface;

class Breadcrumbs implements RenderInterface
{

    /**
     * Registered route names.
     *
     * @var array
     */
    protected $routeNames = [];

    /**
     * @var Router
     */
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function render()
    {
        dd($this->router->getRoutes());
        return 'foo crumbs!';
    }

    public function setRoute($routeName)
    {
        $this->routeNames[] = $routeName;

        return $this;
    }

    public function getRegisteredRoutes()
    {
        $routes = [];
        $routeCollection = $this->router->getRoutes();

        foreach ($this->routeNames as $routeName) {
            $route = $routeCollection->getByName($routeName);

            $routes[$routeName] = $route->uri();
        }

        return $routes;
    }
}
