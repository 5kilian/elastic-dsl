<?php namespace elastic\dsl\query\fulltext;


/**
 * Supports the compact Lucene query string syntax, allowing you
 * to specify AND|OR|NOT conditions and multi-field search within
 * a single query string. For expert users only.
 *
 * @package elastic\dsl\query\fulltext
 */
class QueryStringQuery extends SimpleQueryStringQuery {

    protected $query_type = 'query_string';

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

    public function toArray() {
        // TODO
    }
}
