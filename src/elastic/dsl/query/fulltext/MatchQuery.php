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
     * The actual query to be parsed.
     *
     * @var mixed
     */
    public $query;

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
     * @param string $field
     * @param mixed $query
     */
    public function __construct($field, $query) {
        $this->field = $field;
        $this->query = $query;
    }

    public function toArray() {
        $query = [ 'query' => $this->query ];

        if ($this->operator !== 'or') $query['operator'] = $this->operator;
        if (isset($this->minimum_should_match)) $query['minimum_should_match'] = $this->minimum_should_match;
        if (isset($this->analyzer)) $query['analyzer'] = $this->analyzer;
        if ($this->lenient) $query['lenient'] = $this->lenient;
        if (isset($this->fuzziness)) $query['fuzziness'] = $this->fuzziness;
        if (isset($this->prefix_length)) $query['prefix_length'] = $this->prefix_length;
        if (isset($this->max_expansion)) $query['max_expansion'] = $this->max_expansion;
        if (!$this->fuzzy_transpositions) $query['fuzzy_transpositions'] = $this->fuzzy_transpositions;
        if ($this->zero_terms_query !== 'none') $query['zero_terms_query'] = $this->zero_terms_query;
        if (isset($this->cutoff_frequency)) $query['cutoff_frequency'] = $this->cutoff_frequency;
        if (!$this->fuzzy_transpositions) $query['fuzzy_transpositions'] = $this->fuzzy_transpositions;

        return [ 'query' => [ $this->query_type => [ $this->field => (count($query) === 1 ? $this->query : $query) ] ] ];
    }
}
