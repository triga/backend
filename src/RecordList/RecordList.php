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

    /**
     * @var Decorator
     */
    protected $decorator;

    /**
     * @var array
     */
    protected $columnHeaders = [];

    /**
     * @param QueryBuilder $queryBuilder
     * @param Filter $filterManager
     * @param Sorting $sorting
     * @param Url $url
     * @param View $view
     * @param Paginator $paginator
     * @param Decorator $decorator
     */
    public function __construct(
        QueryBuilder $queryBuilder,
        Filter $filterManager,
        Sorting $sorting,
        Url $url,
        View $view,
        Paginator $paginator,
        Decorator $decorator
    ) {
        $this->queryBuilder = $queryBuilder;
        $this->filterManager = $filterManager;
        $this->sorting = $sorting;
        $this->url = $url;
        $this->view = $view;
        $this->paginator = $paginator;
        $this->decorator = $decorator;

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
        $results = $this->queryBuilder->getResults();
        $results = $this->decorator->decorate($results);

        return $this->view->make($this->getViewPath(), [
            'columns' => $this->getColumns(),
            'results' => $results,
            'order_dir' => $this->sorting->getOrderDir(),
            'order_by' => $this->sorting->getOrderColumn(),
            'url_builder' => $this->url,
            'pagination' => $this->paginator->render($results),
            'params' => $this->url->getParams(),
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
     * Registers a field decorator.
     *
     * @param string $field
     * @param callable $decoratorFunction
     * @return $this
     */
    public function decorate($field, callable $decoratorFunction)
    {
        $this->decorator->registerFieldDecorator($field, $decoratorFunction);

        return $this;
    }

    /**
     * Sets the record page limit (records per page).
     *
     * @param int $perPage
     * @return $this
     */
    public function setPageLimit($perPage)
    {
        $this->paginator->setRecordLimitPerPage($perPage);

        return $this;
    }

    /**
     * Sets columns headers to be displayed.
     *
     * @param array $columnHeaders
     * @return $this
     */
    public function setColumnHeaders($columnHeaders)
    {
        $this->columnHeaders = $columnHeaders;

        return $this;
    }

    /**
     * Returns array of columns with proper headers and in proper order.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [];

        foreach ($this->queryBuilder->getColumns() as $column) {
            if (array_key_exists($column, $this->columnHeaders)) {
                $columns[$column] = $this->columnHeaders[$column];
            } else {
                $columns[$column] = $column;
            }
        }

        $sortOrderArray = array_values($this->columnHeaders);
        uasort($columns, function($value1, $value2) use ($sortOrderArray) {
            return (array_search($value1, $sortOrderArray) > array_search($value2, $sortOrderArray));
        });

        return $columns;
    }
}
