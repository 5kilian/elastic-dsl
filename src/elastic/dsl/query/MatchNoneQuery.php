<?php namespace elastic\dsl\query;


/**
 * This is the inverse of the match_all query, which matches no documents.
 *
 * @package elastic\dsl\query
 */
class MatchNoneQuery extends LeafQuery {

    public function toArray() {
        return [ "query" => [ "match_none" => [ ] ] ];
    }

}
