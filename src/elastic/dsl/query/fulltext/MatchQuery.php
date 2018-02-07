<?php namespace elastic\dsl\query\fulltext;


/**
 * The standard query for performing full text queries,
 * including fuzzy matching and phrase or proximity queries.
 *
 * @package elastic\dsl\query\fulltext
 */
class MatchQuery extends FullTextQuery {

    protected $query_type = 'match';

    /**
     * @var string
     */
    public $field;

    /**
     * If the analyzer used removes all tokens in a query like
     * a stop filter does, the default behavior is to match
     * no documents at all. In order to change that the
     * zero_terms_query option can be used, which accepts
     * none (default) and all which corresponds to a match_all query.
     *
     * @var string
     */
    public $zero_terms_query = 'none';

    /**
     * The match query supports a cutoff_frequency that allows
     * specifying an absolute or relative document frequency
     * where high frequency terms are moved into an optional
     * subquery and are only scored if one of the low frequency
     * (below the cutoff) terms in the case of an or operator
     * or all of the low frequency terms in the case of an
     * and operator match.
     *
     * @var float
     */
    public $cutoff_frequency = null;

    /**
     * The match query is of type boolean. It means that the text
     * provided is analyzed and the analysis process constructs
     * a boolean query from the provided text.
     *
     * @param string $query
     * @param string $field
     */
    public function __construct($query, $field) {
        $this->query = $query;
        $this->field = $field;
    }

    public function toArray() {
        $query = parent::toArray();

        if ($this->zero_terms_query !== 'none') $query['zero_terms_query'] = $this->zero_terms_query;
        if (isset($this->cutoff_frequency)) $query['cutoff_frequency'] = $this->cutoff_frequency;

        return [ 'query' => [ $this->query_type => [ $this->field => (count($query) === 1 ? $this->query : $query) ] ] ];
    }
}
