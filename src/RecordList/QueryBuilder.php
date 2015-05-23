<?php namespace TrigaBackend\RecordList;

use Illuminate\Database\Query\Builder as Query;
use Illuminate\Http\Request;

/**
 * Query builder.
 *
 * @package TrigaBackend\RecordList
 */
class QueryBuilder
{

    /**
     * @var Query
     */
    protected $query;

    /**
     * @var Sorting
     */
    protected $sorting;

    /**
     * @var Filter
     */
    protected $filterManager;

    /**
     * @var Query results.
     */
    protected $results;

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Registers the query.
     *
     * @param Query $query
     * @return $this
     */
    public function setQuery(Query $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Returns an array of columns fetched by the query.
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->query->columns;
    }

    /**
     * Returns the query results.
     *
     * @param bool $force If true, query will be compiled again.
     * @return array
     */
    public function getResults($force = false)
    {
        if (true === empty($this->results) || true === $force) {
            $this->results = $this->compile();
        }
        var_dump($this->query->toSql());
        return $this->results;
    }

    /**
     * Compiles and runs the query, then returns the results.
     *
     * @return array
     */
    protected function compile()
    {
        $this->applySorting()
            ->applyFilters();

        return $this->query->get();
    }

    /**
     * Registers the sorting object.
     *
     * @param Sorting $sorting
     * @return $this
     */
    public function setSorting(Sorting $sorting)
    {
        $this->sorting = $sorting;

        return $this;
    }

    /**
     * Applies sorting conditions to the query.
     */
    protected function applySorting()
    {
        $this->query->orderBy($this->sorting->getOrderColumn(), $this->sorting->getOrderDir());

        return $this;
    }

    /**
     * Registers the filter manager.
     *
     * @param Filter $filterManager
     * @return $this
     */
    public function setFilterManager(Filter $filterManager)
    {
        $this->filterManager = $filterManager;

        return $this;
    }

    protected function applyFilters()
    {
        foreach ($this->filterManager->getFilters() as $field => $filter) {

            // Get the field value from the request
            $requestValue = $this->request->get($field);

            // If the value is set, apply the filter
            if ($requestValue) {
                $filter($this->query, $requestValue);
            }
        }
    }

}
