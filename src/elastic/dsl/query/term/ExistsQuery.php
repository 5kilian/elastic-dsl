<?php namespace elastic\dsl\query\term;


/**
 * Find documents where the field specified contains any non-null value.
 *
 * @package elastic\dsl\query\term
 */
class ExistsQuery extends TermLevelQuery {

    /**
     * @var string
     */
    public $field;

    public function __construct($field) {
        $this->field = $field;
    }

    public function toArray() {
        return [ "exists" => [ "field" => $this->field ] ];
    }
}
