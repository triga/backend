<?php namespace TrigaBackend\RecordList;

use Illuminate\Database\Query\Builder as Query;
use Illuminate\View\Factory as View;
use TrigaBackend\Contract\RenderInterface;

/**
 * RecordList component. Responsible for displaying a table with database entries.
 * Additionally can display pagination, apply query filters and utilize result sorting.
 *
 * @package TrigaBackend\RecordList
 */
class RecordList implements RenderInterface
{

    /**
     * Default view.
     *
     * @var string
     */
    private $viewPath = 'trigabackend::recordlist.recordlist';

    /**
     * Query builder.
     *
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * Query filter manager.
     *
     * @var Filter
     */
    private $filterManager;

    /**
     * View manager.
     *
     * @var View
     */
    private $view;

    public function __construct(QueryBuilder $queryBuilder, Filter $filterManager, View $view)
    {
        $this->queryBuilder = $queryBuilder;
        $this->filterManager = $filterManager;
        $this->view = $view;
    }

    /**
     * Query builder setter.
     *
     * @param Query $query
     * @return $this
     */
    public function setQuery(Query $query)
    {
        $this->queryBuilder->setQuery($query);

        return $this;
    }

    /**
     * Returns a compiled view as a string.
     *
     * @return string
     */
    public function render()
    {
        return $this->view->make($this->getViewPath(), [
            'columns' => $this->queryBuilder->getColumns(),
            'results' => $this->queryBuilder->getResults(),
        ]);
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
     * Returns the view path.
     *
     * @return string
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }
}
