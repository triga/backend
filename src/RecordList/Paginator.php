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

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setRecordLimiPerPage($perPage)
    {
        $this->perPage = (int)$perPage;

        return $this;
    }

    public function getRecordLimiPerPage()
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
