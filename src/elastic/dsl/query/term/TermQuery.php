<?php namespace elastic\dsl\query\term;


/**
 * Find documents which contain the exact term specified in the field specified.
 *
 * @package elastic\dsl\query\term
 */
class TermQuery extends TermLevelQuery {

    /**
     * @var string
     */
    public $field;

    /**
     * @var mixed
     */
    public $value;

    /**
     * @var float
     */
    public $boost = 1.0;

    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function toArray() {
        $value = [ "value" => $this->value ];

        if ($this->boost !== 1) $value['boost'] = $this->boost;

        return [ "term" => [ $this->field => (count($value) === 1 ? $this->value : $value) ] ];
    }

}
