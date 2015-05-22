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
    
}
