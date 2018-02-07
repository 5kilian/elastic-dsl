<?php namespace elastic\dsl\query\fulltext;


/**
 * The multi-field version of the match query.
 *
 * @package elastic\dsl\query\fulltext
 */
class MultiMatchQuery extends FullTextQuery {

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
     * @param string $query
     * @param array $fields
     */
    public function __construct($query, $fields = []) {
        $this->query = $query;
        $this->fields = $fields;
    }

    public function toArray() {
        $query = parent::toArray();

        $query['fields'] = $this->fields;
        if ($this->type !== 'best_fields') $query['type'] = $this->type;
        if (isset($this->tie_breaker)) $query['tie_breaker'] = $this->tie_breaker;

        return [ "query" => [ $this->query_type => $query ] ];
    }

}
