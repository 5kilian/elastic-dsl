<?php namespace elastic\dsl\query\fulltext;

use elastic\dsl\query\AbstractQuery;

/**
 * The high-level full text queries are usually used for running
 * full text queries on full text fields like the body of an email.
 * They understand how the field being queried is analyzed
 * and will apply each field’s analyzer (or search_analyzer)
 * to the query string before executing.
 *
 * @package elastic\dsl\query\fulltext
 */
abstract class FullTextQuery extends AbstractQuery {

    protected $query_type = null;

    /**
     * The minimum number of optional should clauses to match
     * can be set using the minimum_should_match parameter.
     *
     * @var mixed
     */
    public $minimum_should_match = null;
}