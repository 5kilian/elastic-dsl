<?php namespace elastic\dsl\query\fulltext;


/**
 * The poor man’s search-as-you-type. Like the match_phrase query,
 * but does a wildcard search on the final word.
 *
 * @package elastic\dsl\query\fulltext
 */
class MatchPhrasePrefixQuery extends MatchPhraseQuery {

    protected $query_type = 'match_phrase_prefix';

}