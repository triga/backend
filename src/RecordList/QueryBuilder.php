<?php namespace TrigaBackend\RecordList;

use Illuminate\Database\Query\Builder as Query;

/**
 * Query builder.
 *
 * @package TrigaBackend\RecordList
 */
class QueryBuilder {

    /**
     * @var Query
     */
    protected $query;

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
     * @return array
     */
    public function getResults()
    {
        return $this->query->get();
    }
    
}
