<?php namespace elastic\dsl\query\fulltext;


/**
 * A more specialized query which gives more preference to uncommon words.
 *
 * @package elastic\dsl\query\fulltext
 */
class CommonTermsQuery extends MatchQuery {

    protected $query_type = 'common';

}
