<?php namespace elastic\dsl\query\term;


/**
 * Find documents where the field specified contains terms
 * which match the regular expression specified.
 *
 * @package elastic\dsl\query\term
 */
class RegexpQuery extends TermLevelQuery {

    /**
     * @var string
     */
    public $field;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $boost = null;

    /**
     * @var string
     */
    public $flags = null;

    /**
     * @var int
     */
    public $max_determinized_states = 10000;

    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function boost($boost) {
        $this->boost = $boost;
        return $this;
    }

    public function flags($flags) {
        $this->flags = $flags;
        return $this;
    }

    public function maxDeterminizedStates($max_determinized_states) {
        $this->max_determinized_states = $max_determinized_states;
        return $this;
    }

    public function toArray() {
        $query = [ 'value' => $this->value ];

        if (isset($this->boost)) $query['boost'] = $this->boost;
        if (isset($this->flags)) $query['flags'] = $this->flags;
        if ($this->max_determinized_states !== 10000) $query['max_determinized_states'] = $this->max_determinized_states;

        return [ "regexp" => [ $this->field => count($query)>1 ? $query : $this->value ] ];
    }
}
