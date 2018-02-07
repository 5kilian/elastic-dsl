<?php namespace elastic\dsl\query;


/**
 * The most simple query, which matches all documents, giving them all a _score of 1.0.
 * The _score can be changed with the boost parameter.
 *
 * @package elastic\dsl\query
 */
class MatchAllQuery extends LeafQuery {

    public $boost = null;

    public function __construct($boost = null) {
        $this->boost = $boost;
    }

    public function toArray() {
        $query = [ "query" => [ "match_all" => [ ] ] ];
        if ($this->boost !== null) $query['query']['match_all']['boost'] = $this->boost;
        return $query;
    }

}
