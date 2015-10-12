<?php namespace TrigaBackend\RecordList;

/**
 * Field decorator.
 *
 * @package TrigaBackend\RecordList
 */
class Decorator
{
    /**
     * Registered decorators.
     *
     * @var array
     */
    protected $decorators = [];

    /**
     * Registers decorator for field.
     *
     * @param string $fieldName
     * @param callable $decorator
     * @return $this
     */
    public function registerFieldDecorator($fieldName, callable $decorator)
    {
        $this->decorators[$fieldName] = $decorator;

        return $this;
    }

    /**
     * Applies decorators on records fields.
     *
     * @param array $records
     * @return array
     */
    public function decorate($records)
    {
        foreach ($records as $record) {
            foreach ($this->decorators as $field => $decorator) {
                if (false === property_exists($record, $field)) {
                    continue;
                }

                $record->{$field} = $decorator($record);
            }
        }

        return $records;
    }
}
