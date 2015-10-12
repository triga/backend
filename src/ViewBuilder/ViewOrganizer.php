<?php namespace TrigaBackend\ViewBuilder;

use TrigaBackend\Contract\RenderInterface;

/**
 * Helper class making building the bavkend view easier.
 *
 * @package TrigaBackend\ViewBuilder
 */
class ViewOrganizer
{
    /**
     * Sidebar view.
     *
     * @var RenderInterface
     */
    protected $sideBar;

    /**
     * Main content view.
     *
     * @var RenderInterface
     */
    protected $mainContent;

    /**
     * Page header text.
     *
     * @var string
     */
    protected $header;

    /**
     * Breadcrumbs view.
     *
     * @var RenderInterface
     */
    protected $breadCrumbs;

    /**
     * @return RenderInterface
     */
    public function getSideBar()
    {
        return $this->sideBar;
    }

    /**
     * @param RenderInterface $sideBar
     * @return $this
     */
    public function setSideBar(RenderInterface $sideBar)
    {
        $this->sideBar = $sideBar;

        return $this;
    }

    /**
     * @return RenderInterface
     */
    public function getMainContent()
    {
        return $this->mainContent;
    }

    /**
     * @param RenderInterface $mainContent
     * @return $this
     */
    public function setMainContent(RenderInterface $mainContent)
    {
        $this->mainContent = $mainContent;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param string $header
     * @return $this
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * @return string
     */
    public function getBreadCrumbs()
    {
        return $this->breadCrumbs;
    }

    /**
     * @param RenderInterface $breadCrumbs
     * @return $this
     */
    public function setBreadCrumbs(RenderInterface $breadCrumbs)
    {
        $this->breadCrumbs = $breadCrumbs;

        return $this;
    }
}
