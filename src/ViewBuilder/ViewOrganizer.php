<?php namespace TrigaBackend\ViewBuilder;

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
     * @var string
     */
    protected $sideBar;

    /**
     * Main content view.
     *
     * @var string
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
     * @var string
     */
    protected $breadCrumbs;

    /**
     * @return string
     */
    public function getSideBar()
    {
        return $this->sideBar;
    }

    /**
     * @param string $sideBar
     * @return $this
     */
    public function setSideBar($sideBar)
    {
        $this->sideBar = $sideBar;

        return $this;
    }

    /**
     * @return string
     */
    public function getMainContent()
    {
        return $this->mainContent;
    }

    /**
     * @param string $mainContent
     * @return $this
     */
    public function setMainContent($mainContent)
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
     * @param string $breadCrumbs
     * @return $this
     */
    public function setBreadCrumbs($breadCrumbs)
    {
        $this->breadCrumbs = $breadCrumbs;

        return $this;
    }
}
