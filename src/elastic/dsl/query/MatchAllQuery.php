<?php namespace elastic\dsl\query;


class MatchAllQuery extends AbstractQuery {

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
