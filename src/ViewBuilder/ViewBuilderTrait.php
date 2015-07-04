<?php namespace TrigaBackend\ViewBuilder;

trait ViewBuilderTrait
{
    protected $layoutPath = 'trigabackend::layout.layout';

    protected function buildView(ViewOrganizer $viewOrganizer)
    {
        return view($this->layoutPath, [
            'side_bar' => $viewOrganizer->getSideBar(),
            'main_content' => $viewOrganizer->getMainContent(),
        ]);
    }

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
