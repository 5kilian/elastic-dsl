<?php namespace elastic\dsl\query\term;


/**
 * Find documents which match with one or more of the specified terms.
 * The number of terms that must match depend on the specified
 * minimum should match field or script.
 *
 * @package elastic\dsl\query\term
 */
class TermsSetQuery extends TermLevelQuery {

    /**
     * @var string
     */
    public $field;

    /**
     * @var array
     */
    public $values;

    /**
     * @var mixed
     */
    public $minimum_should_match_field = null;

    public function __construct($field, $values) {
        $this->field = $field;
        $this->values = $values;
    }

    public function toArray() {
        $query = [ "terms" => $this->values];

        if (isset($this->minimum_should_match_field)) $query['minimum_should_match_field'] = $this->minimum_should_match_field;

        return [ "terms_set" => [ $this->field => $query ] ];
    }

}
