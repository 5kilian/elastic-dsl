<?php namespace elastic\dsl\query\fulltext;

use elastic\dsl\query\LeafQuery;

/**
 * The high-level full text queries are usually used for running
 * full text queries on full text fields like the body of an email.
 * They understand how the field being queried is analyzed
 * and will apply each field’s analyzer (or search_analyzer)
 * to the query string before executing.
 *
 * @package elastic\dsl\query\fulltext
 */
abstract class FullTextQuery extends LeafQuery {

    protected $query_type = null;

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
     * The minimum number of optional should clauses to match
     * can be set using the minimum_should_match parameter.
     *
     * @var mixed
     */
    public $minimum_should_match = null;

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

}
