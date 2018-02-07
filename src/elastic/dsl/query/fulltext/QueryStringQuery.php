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

    public function toArray() {

    }
}