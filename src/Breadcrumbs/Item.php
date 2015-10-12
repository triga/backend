<?php namespace TrigaBackend\Breadcrumbs;

use TrigaBackend\Contract\RenderInterface;

/**
 * Breadcrumb entry.
 *
 * @package TrigaBackend\Breadcrumbs
 */
class Item implements RenderInterface
{
    /**
     * Displayed title.
     *
     * @var string
     */
    protected $title;

    /**
     * URL of the route.
     *
     * @var string
     */
    protected $url;

    /**
     * If true, the route is current (not clickable).
     *
     * @var bool
     */
    protected $current = true;

    /**
     * "Font awesome" icon class name.
     *
     * @var string
     */
    protected $icon;

    /**
     * @param string $title
     * @param string $url
     * @param string|null $icon
     */
    public function __construct($title, $url, $icon = null)
    {
        $this->title = $title;
        $this->url = $url;
        $this->icon = $icon;
    }

    /**
     * Renders the view.
     *
     * @return string
     */
    public function render()
    {
        return view('trigabackend::breadcrumbs.item', [
            'item' => $this,
        ]);
    }

    /**
     * Sets the route as current (or not).
     *
     * @param bool $current
     */
    public function setAsCurrent($current)
    {
        $this->current = (bool)$current;
    }

    /**
     * Returns true if the route is current.
     *
     * @return bool
     */
    public function isCurrent()
    {
        return $this->current;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return null|string
     */
    public function getIcon()
    {
        return $this->icon;
    }
}
