<?php namespace elastic\dsl\query\term;


/**
 * Find documents where the field specified contains terms
 * which match the pattern specified, where the pattern
 * supports single character wildcards (?)
 * and multi-character wildcards (*)
 *
 * @package elastic\dsl\query\term
 */
class WildcardQuery extends TermLevelQuery {

    /**
     * @var string
     */
    public $field;

    /**
     * @var string
     */
    public $value;

    /**
     * @var double
     */
    public $boost = 1.0;

    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function toArray() {
        return [ "prefix" => [ $this->field => $this->value ] ];
    }

}
