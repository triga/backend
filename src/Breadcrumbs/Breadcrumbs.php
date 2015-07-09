<?php namespace TrigaBackend\Breadcrumbs;

use Illuminate\Routing\Router;
use TrigaBackend\Contract\RenderInterface;

class Breadcrumbs implements RenderInterface
{

    /**
     * Route names to be used in breadcrumbs.
     *
     * @var array
     */
    protected $routeNames = [];

    /**
     * @var Router
     */
    protected $router;

    /**
     * Routes registered in the application.
     *
     * @var array
     */
    protected $registeredRoutes = [];

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->registeredRoutes = $this->getRegisteredRoutes();
    }

    public function render()
    {
//        $routes = $this->getRegisteredRoutes();

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

            if (true === empty($route)) {
                throw new \InvalidArgumentException(sprintf('Route "%s" does not exist', $routeName));
            }

            $routes[$routeName] = $route->uri();
        }

        return $routes;
    }
}
