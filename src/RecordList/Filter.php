<?php namespace TrigaBackend\RecordList;

/**
 * Filter manager.
 *
 * @package TrigaBackend\RecordList
 */
class Filter
{
    /**
     * Registered filters;
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Registers a filter.
     *
     * @param string $filterName
     * @param callable $filter
     * @return $this
     */
    public function registerFilter($filterName, callable $filter)
    {
        $this->filters[$filterName] = $filter;

        return $this;
    }

    /**
     * Returns all registered filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
