<?php namespace TrigaBackend\RecordList;

/**
 * RecordList paginator.
 *
 * @package TrigaBackend\RecordList
 */
class Paginator
{
    protected $perPage = 20;

    public function setRecordLimiPerPage($perPage)
    {
        $this->perPage = (int)$perPage;

        return $this;
    }

    public function getRecordLimiPerPage()
    {
        return $this->perPage;
    }
}
