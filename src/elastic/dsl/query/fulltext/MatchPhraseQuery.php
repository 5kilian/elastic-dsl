<?php namespace elastic\dsl\query\fulltext;


/**
 * Like the match query but used for matching exact
 * phrases or word proximity matches.
 *
 * @package elastic\dsl\query\fulltext
 */
class MatchPhraseQuery extends MatchQuery {

    protected $query_type = 'match_phrase';

}