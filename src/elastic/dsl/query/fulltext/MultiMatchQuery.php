<?php namespace elastic\dsl\query\fulltext;


/**
 * The multi-field version of the match query.
 *
 * @package elastic\dsl\query\fulltext
 */
class MultiMatchQuery extends MatchQuery {

    protected $query_type = 'multi_match';

    /**
     * @var array
     */
    public $fields = [];

    /**
     * The way the multi_match query is executed internally
     * depends on the type parameter, which can be set to:
     * - best_fields
     * - most_fields
     * - cross_fields
     * - phrase
     * - phrase_prefix
     *
     * @var string
     */
    public $type = 'best_fields';

    public $tie_breaker = null;

    /**
     * The match query is of type boolean. It means that the text
     * provided is analyzed and the analysis process constructs
     * a boolean query from the provided text.
     *
     * @param array $fields
     * @param mixed $value
     */
    public function __construct($fields, $value) {
        parent::__construct('', $value);
    }

    public function toArray() {
        $query = parent::toArray();

        $query['query'][$this->query_type] = $query['query'][$this->query_type][$this->field];
        $query['query'][$this->query_type]['fields'] = $this->fields;
        if ($this->type !== 'best_fields') $query['query'][$this->query_type]['type'] = $this->type;
        if (isset($this->tie_breaker)) $query['query'][$this->query_type]['tie_breaker'] = $this->tie_breaker;

        return $query;
    }

}
