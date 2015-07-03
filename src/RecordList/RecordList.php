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
    protected $viewPath = 'trigabackend::recordlist.recordlist';

    /**
     * Query builder.
     *
     * @var QueryBuilder
     */
    protected $queryBuilder;

    /**
     * Query filter manager.
     *
     * @var Filter
     */
    protected $filterManager;

    /**
     * Sorting manager.
     *
     * @var Sorting
     */
    protected $sorting;

    /**
     * URL builder.
     *
     * @var Url
     */
    protected $url;

    /**
     * View manager.
     *
     * @var View
     */
    protected $view;

    /**
     * @var Paginator
     */
    protected $paginator;

    public function __construct(
        QueryBuilder $queryBuilder,
        Filter $filterManager,
        Sorting $sorting,
        Url $url,
        View $view,
        Paginator $paginator
    )
    {
        $this->queryBuilder = $queryBuilder;
        $this->filterManager = $filterManager;
        $this->sorting = $sorting;
        $this->url = $url;
        $this->view = $view;
        $this->paginator = $paginator;

        $this->queryBuilder->setSorting($sorting);
        $this->queryBuilder->setPaginator($paginator);
        $this->queryBuilder->setFilterManager($filterManager);
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
            'order_dir' => $this->sorting->getOrderDir(),
            'order_by' => $this->sorting->getOrderColumn(),
            'url_builder' => $this->url,
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

    /**
     * Registers a query filter.
     *
     * @param string $field
     * @param callable $filterFunction
     * @return $this
     */
    public function filter($field, callable $filterFunction)
    {
        $this->filterManager->registerFilter($field, $filterFunction);

        return $this;
    }

    /**
     * Sets the record page limit (records per page).
     *
     * @param $perPage
     * @return $this
     */
    public function setPageLimit($perPage)
    {
        $this->paginator->setRecordLimiPerPage($perPage);

        return $this;
    }
}
