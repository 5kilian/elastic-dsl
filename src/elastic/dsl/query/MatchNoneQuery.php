<?php namespace elastic\dsl\query;


class MatchNoneQuery extends AbstractQuery {

    public function toArray() {
        return [ "query" => [ "match_none" => [ ] ] ];
    }

}
