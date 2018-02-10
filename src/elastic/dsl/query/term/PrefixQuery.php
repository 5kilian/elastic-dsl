<?php namespace elastic\dsl\query\term;


/**
 * Find documents where the field specified contains terms
 * which begin with the exact prefix specified.
 *
 * @package elastic\dsl\query\term
 */
class PrefixQuery extends TermLevelQuery {

    /**
     * @var string
     */
    public $field;

    /**
     * @var string
     */
    public $prefix;

    /**
     * @var double
     */
    public $boost = 1.0;

    public function __construct($field, $prefix) {
        $this->field = $field;
        $this->prefix = $prefix;
    }

    public function toArray() {
        return [ "prefix" => [ $this->field => $this->prefix ] ];
    }

}
