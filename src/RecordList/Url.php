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

    /**
     * @param Request $request
     */
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
        $query = urldecode(http_build_query(array_merge(
            $this->request->input(),
            [Sorting::ORDER_BY_KEY => $orderBy, Sorting::ORDER_DIR_KEY => $orderDir, 'page' => $this->request->get('page', 1)]
        )));

        return $this->getUrl() . '/?' . $query;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->request->all();
    }

    /**
     * Returns the base URL.
     *
     * @return string
     */
    protected function getUrl()
    {
        if (true === empty($this->url)) {
            $this->url = $this->request->url();
        }

        return $this->url;
    }
}
