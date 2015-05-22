<?php namespace TrigaBackend\Contract;

/**
 * Render interface.
 *
 * @package TrigaBackend\Contract
 */
interface RenderInterface {

    /**
     * Returns a compiled view as a string.
     *
     * @return string
     */
    public function render();

}
