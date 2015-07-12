<?php namespace TrigaBackend\Breadcrumbs;

use Illuminate\Routing\UrlGenerator;
use TrigaBackend\Contract\RenderInterface;

/**
 * Class responsible for generating the breadcrumbs.
 *
 * @package TrigaBackend\Breadcrumbs
 */
class Breadcrumbs implements RenderInterface
{

    /**
     * Default view.
     *
     * @var string
     */
    protected $viewPath = 'trigabackend::breadcrumbs.breadcrumbs';

    /**
     * Registered breadcrumb items.
     *
     * @var Item[]
     */
    protected $items = [];

    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Renders the view.
     *
     * @return string
     */
    public function render()
    {
        return view($this->viewPath, [
            'breadcrumbs' => $this->items,
        ]);
    }

    /**
     * Registers a route.
     *
     * @param string $routeName
     * @param string $title
     * @param null $icon
     * @param array $routeParams
     * @return $this
     */
    public function setRoute($routeName, $title, $icon = null, array $routeParams = [])
    {
        $this->resetCurrent();

        $this->items[] = new Item($title, $this->urlGenerator->route($routeName, $routeParams), $icon);

        return $this;
    }

    /**
     * Returns all registered routes.
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->items;
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

    /**
     * Sets the previos route as inactive (active routes are not clickable).
     */
    protected function resetCurrent()
    {
        if (true === empty($this->items)) {
            return;
        }

        $lastItem = $this->items[count($this->items) - 1];

        $lastItem->setAsCurrent(false);
    }
}
