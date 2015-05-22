<?php namespace TrigaBackend\RecordList;

use \Illuminate\Http\Request;

/**
 * Class responsible for sorting of records from RecordList.
 *
 * @package TrigaBackend\RecordList
 */
class Sorting {

    /**
     * Order direction request key.
     */
    const ORDER_DIR_KEY = 'order_dir';

    /**
     * Order column request key.
     */
    const ORDER_DIR_BY = 'order_by';

    /**
     * Order direction values.
     */
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getOrderDir()
    {
        $orderDir = strtolower($this->request->get(self::ORDER_DIR_KEY));

        // Set default order if empty or invalid
        if (true === empty($orderDir) || false === in_array($orderDir, [self::ORDER_ASC, self::ORDER_DESC])) {
            $orderDir = self::ORDER_ASC;
        }

        return $orderDir;
    }
}
