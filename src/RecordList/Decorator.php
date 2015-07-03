<?php namespace TrigaBackend\RecordList;

/**
 * Field decorator.
 *
 * @package TrigaBackend\RecordList
 */
class Decorator
{
    protected $decorators = [];

    public function registerFieldDecorator($fieldName, callable $decorator)
    {
        $this->decorators[$fieldName] = $decorator;
    }

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
