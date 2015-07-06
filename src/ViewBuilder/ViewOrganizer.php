<?php namespace TrigaBackend\ViewBuilder;

class ViewOrganizer
{
    protected $sideBar;
    protected $mainContent;

    /**
     * @return mixed
     */
    public function getSideBar()
    {
        return $this->sideBar;
    }

    /**
     * @param mixed $sideBar
     */
    public function setSideBar($sideBar)
    {
        $this->sideBar = $sideBar;
    }

    /**
     * @return mixed
     */
    public function getMainContent()
    {
        return $this->mainContent;
    }

    /**
     * @param mixed $mainContent
     */
    public function setMainContent($mainContent)
    {
        $this->mainContent = $mainContent;
    }
}
