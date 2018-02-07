<?php namespace elastic\dsl\query\fulltext;


/**
 * Supports the compact Lucene query string syntax, allowing you
 * to specify AND|OR|NOT conditions and multi-field search within
 * a single query string. For expert users only.
 *
 * @package elastic\dsl\query\fulltext
 */
class QueryStringQuery extends FullTextQuery {

    protected $query_type = 'query_string';

    /**
     * The default field for query terms if no prefix field is specified.
     * Defaults to the index.query.default_field index settings,
     * which in turn defaults to *. * extracts all fields in the mapping
     * that are eligible to term queries and filters the metadata fields.
     * All extracted fields are then combined to build a query when
     * no prefix field is provided.
     *
     * @var string
     */
    public $default_field = null;

    /**
     * The query_string query can also run against multiple fields.
     * Fields can be provided via the "fields" parameter (example below).
     *
     * @var array
     */
    public $fields = [];

    /**
     * The default operator used if no explicit operator is specified.
     * For example, with a default operator of OR, the query capital of
     * Hungary is translated to capital OR of OR Hungary, and with
     * default operator of AND, the same query is translated to capital
     * AND of AND Hungary. The default value is OR.
     *
     * @var string
     */
    public $default_operator = null;

    /**
     * The name of the analyzer that is used to analyze quoted
     * phrases in the query string. For those parts, it overrides
     * other analyzers that are set using the analyzer parameter or
     * the search_quote_analyzer setting.
     *
     * @var string
     */
    public $quote_analyzer = null;

    /**
     * By default, wildcards terms in a query string are not analyzed.
     * By setting this value to true, a best effort will be made to
     * analyze those as well.
     *
     * @var bool
     */
    public $analyze_wildcard = false;

    /**
     * When set, * or ? are allowed as the first character.
     * Defaults to true.
     *
     * @var bool
     */
    public $allow_leading_wildcard = true;

    /**
     * Set to true to enable position increments in result queries.
     * Defaults to true.
     *
     * @var bool
     */
    public $enable_position_increments = true;

    /**
     * Sets the default slop for phrases. If zero, then exact phrase
     * matches are required. Default value is 0.
     *
     * @var int
     */
    public $phrase_slop = 0;

    /**
     * Sets the boost value of the query. Defaults to 1.0.
     *
     * @var float
     */
    public $boost = 1.0;

    /**
     * Defaults to false.
     *
     * @var bool
     */
    public $auto_generate_phrase_queries = false;

    /**
     * Whether phrase queries should be automatically generated
     * for multi terms synonyms. Defaults to true.
     *
     * @var bool
     */
    public $auto_generate_synonyms_phrase_query = true;

    /**
     * Limit on how many automaton states regexp queries are allowed to create.
     * This protects against too-difficult (e.g. exponentially hard) regexps.
     * Defaults to 10000.
     *
     * @var int
     */
    public $max_determinized_states = 10000;

    /**
     * Time Zone to be applied to any range query related to dates.
     * See also JODA timezone.
     *
     * @var string
     */
    public $time_zone = null;

    /**
     * A suffix to append to fields for quoted parts of the query string.
     * This allows to use a field that has a different analysis chain for
     * exact matching.
     *
     * @var string
     */
    public $quote_field_suffix = null;

    public function __construct($query, $fields = []) {
        $this->query = $query;
        $this->fields = $fields;
    }

    public function toArray() {
        $query = parent::toArray();

        if (isset($this->quote_analyzer)) $query['analyzer'] = $this->quote_analyzer;
        if (isset($this->default_operator)) $query['default_operator'] = $this->default_operator;
        if (isset($this->default_field)) $query['default_field'] = $this->default_field;
        if (!$this->allow_leading_wildcard) $query['allow_leading_wildcard'] = $this->allow_leading_wildcard;
        if (!$this->enable_position_increments) $query['enable_position_increments'] = $this->enable_position_increments;
        if (isset($query['max_expansion'])) {
            $query['fuzzy_max_expansion'] = $this->max_expansion;
            unset($query['max_expansion']);
        }
        if (isset($query['prefix_length'])) {
            $query['fuzzy_prefix_length'] = $this->prefix_length;
            unset($query['prefix_length']);
        }
        if ($this->phrase_slop !== 0) $query['phrase_slop'] = $this->phrase_slop;
        if ($this->boost !== 0) $query['boost'] = $this->boost;
        if ($this->auto_generate_phrase_queries) $query['auto_generate_phrase_queries'] = $this->auto_generate_phrase_queries;
        if ($this->analyze_wildcard) $query['analyze_wildcard'] = $this->analyze_wildcard;
        if ($this->max_determinized_states !== 10000) $query['max_determinized_states'] = $this->max_determinized_states;
        if (isset($this->time_zone)) $query['time_zone'] = $this->time_zone;
        if (isset($this->quote_field_suffix)) $query['quote_field_suffix'] = $this->quote_field_suffix;
        if (!$this->auto_generate_synonyms_phrase_query) $query['auto_generate_synonyms_phrase_query'] = $this->auto_generate_synonyms_phrase_query;

        return [ "query" => [ $this->query_type => parent::toArray() ] ];
    }

}

