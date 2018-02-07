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
     * @var mixed
     */
    public $value;

    /**
     * The operator flag can be set to or or and to control
     * the boolean clauses (defaults to or).
     *
     * @var string
     */
    public $operator = 'or';

    /**
     * The analyzer can be set to control which analyzer will
     * perform the analysis process on the text. It defaults
     * to the field explicit mapping definition, or the default
     * search analyzer.
     *
     * @var string
     */
    public $analyzer = null;

    /**
     * The lenient parameter can be set to true to ignore exceptions
     * caused by data-type mismatches, such as trying to query
     * a numeric field with a text query string. Defaults to false.
     *
     * @var bool
     */
    public $lenient = false;

    /**
     * fuzziness allows fuzzy matching based on the type of field
     * being queried. See Fuzziness edit for allowed settings.
     * https://www.elastic.co/guide/en/elasticsearch/reference/current/common-options.html#fuzziness
     *
     * @var string
     */
    public $fuzziness = null;

    /**
     * The prefix_length can be set in this case to control the fuzzy process.
     *
     * @var int
     */
    public $prefix_length = null;

    /**
     * The max_expansions can be set in this case to control the fuzzy process.
     * If the fuzzy option is set the query will use top_terms_blended_freqs_${max_expansions}
     * as its rewrite method the fuzzy_rewrite parameter allows
     * to control how the query will get rewritten.
     *
     * @var int
     */
    public $max_expansion = null;

    /**
     * Fuzzy transpositions (ab → ba) are allowed by default but
     * can be disabled by setting fuzzy_transpositions to false.
     *
     * @var bool
     */
    public $fuzzy_transpositions = true;

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
     * The match query supports multi-terms synonym expansion
     * with the synonym_graph token filter. When this filter
     * is used, the parser creates a phrase query for each
     * multi-terms synonyms. For example, the following
     * synonym: "ny, new york" would produce:
     * (ny OR ("new york"))
     *
     * @var bool
     */
    public $auto_generate_synonyms_phrase_query = true;

    /**
     * The match query is of type boolean. It means that the text
     * provided is analyzed and the analysis process constructs
     * a boolean query from the provided text.
     *
     * @param string $field
     * @param mixed $value
     */
    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function toArray() {
        $query = [ 'query' => $this->value ];

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
        if (count($query) === 1) $query = $this->value;

        return [ 'query' => [ $this->query_type => [ $this->field => $query ] ] ];
    }
}
