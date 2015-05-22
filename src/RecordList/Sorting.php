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
    const ORDER_BY_KEY = 'order_by';

    /**
     * Default order column.
     */
    const DEFAULT_ORDER_BY = 'id';

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

    /**
     * Returns the sorting direction.
     *
     * @return string
     */
    public function getOrderDir()
    {
        $orderDir = strtolower($this->request->get(self::ORDER_DIR_KEY));

        // Set default order if empty or invalid
        if (true === empty($orderDir) || false === in_array($orderDir, [self::ORDER_ASC, self::ORDER_DESC])) {
            $orderDir = self::ORDER_ASC;
        }

        return $orderDir;
    }

    /**
     * Returns the sorting column.
     *
     * @return string
     */
    public function getOrderColumn()
    {
        $orderColumn = strtolower($this->request->get(self::ORDER_BY_KEY));

        // Set default order if empty
        if (true === empty($orderColumn)) {
            $orderColumn = self::DEFAULT_ORDER_BY;
        }

        return $orderColumn;
    }

    /**
     * Returns the opposite sorting direction.
     *
     * @return string
     */
    public function getOppositeOrderDir()
    {
        if (self::ORDER_ASC === $this->getOrderDir()) {
            return self::ORDER_DESC;
        }

        return self::ORDER_ASC;
    }
}
