<?php namespace TrigaBackend\RecordList;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * RecordList paginator.
 *
 * @package TrigaBackend\RecordList
 */
class Paginator
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var int Default amount of records per page.
     */
    protected $perPage = 20;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int|string $perPage
     * @return $this
     */
    public function setRecordLimitPerPage($perPage)
    {
        $this->perPage = (int)$perPage;

        return $this;
    }

    /**
     * @return int
     */
    public function getRecordLimitPerPage()
    {
        return $this->perPage;
    }

    /**
     * Appends URI params to the paginator results (excluding the "page" since it will be added by the paginator) and returns the rendered view.
     *
     * @param LengthAwarePaginator $results
     * @return string
     */
    public function render(LengthAwarePaginator $results)
    {
        return $results->appends($this->request->except('page'))
            ->render();
    }
}
