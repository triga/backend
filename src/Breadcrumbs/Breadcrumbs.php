<?php namespace TrigaBackend\Breadcrumbs;

use Illuminate\Routing\UrlGenerator;
use TrigaBackend\Contract\RenderInterface;

class Breadcrumbs implements RenderInterface
{

    /**
     * Default view.
     *
     * @var string
     */
    protected $viewPath = 'trigabackend::breadcrumbs.breadcrumbs';

    /**
     * Route names to be used in breadcrumbs.
     *
     * @var array
     */
    protected $routes = [];

    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function render()
    {
        return view($this->viewPath);
    }

    public function setRoute($routeName, $title, array $params = [])
    {
        $this->routes[$routeName] = [
            'title' => $title,
            'url' => $this->urlGenerator->route($routeName, $params),
        ];

        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Sets the view path.
     *
     * @param string $viewPath
     * @return $this
     */
    public function setViewPath($viewPath)
    {
        $this->viewPath = $viewPath;

        return $this;
    }
}
