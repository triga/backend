<?php namespace TrigaBackend\ViewBuilder;

/**
 * Trait helping build a complete backend layout.
 *
 * @package TrigaBackend\ViewBuilder
 */
trait ViewBuilderTrait
{

    /**
     * Default layout path.
     *
     * @var string
     */
    protected $layoutPath = 'trigabackend::layout.layout';

    /**
     * Passes all variables to the view and returns the result.
     *
     * @param ViewOrganizer $viewOrganizer
     * @return \Illuminate\View\View
     */
    protected function buildView(ViewOrganizer $viewOrganizer)
    {
        return view($this->layoutPath, [
            'header' => $viewOrganizer->getHeader(),
            'side_bar' => $viewOrganizer->getSideBar(),
            'breadcrumbs' => $viewOrganizer->getBreadCrumbs(),
            'main_content' => $viewOrganizer->getMainContent(),
        ]);
    }

    /**
     * Returns a new instance of the view organizer.
     *
     * @return ViewOrganizer
     */
    protected function getViewOrganizer()
    {
        return new ViewOrganizer;
    }

    protected function setLayoutPath($path)
    {
        $this->layoutPath = $path;

        return $this;
    }
}
