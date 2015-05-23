<?php namespace TrigaBackend\RecordList;

use \Illuminate\Http\Request;

/**
 * URL builder for RecordList.
 *
 * @package TrigaBackend\RecordList
 */
class Url
{

    /**
     * @var Request
     */
    private $request;

    /**
     * Base URL.
     *
     * @var string
     */
    private $url;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Returns the URL with passed sorting parameters.
     *
     * @param string $orderBy
     * @param string $orderDir
     * @return string
     */
    public function get($orderBy, $orderDir)
    {
        $query = http_build_query(array_merge(
            [Sorting::ORDER_BY_KEY => $orderBy, Sorting::ORDER_DIR_KEY => $orderDir]
        ));

        return $this->getUrl() . '/?' . $query;
    }

    /**
     * Returns the base URL.
     *
     * @return string
     */
    protected function getUrl(){
        if (true === empty($this->url)) {
            $this->url = $this->request->url();
        }

        return $this->url;
    }
}
