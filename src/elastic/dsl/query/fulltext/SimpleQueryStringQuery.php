<?php namespace elastic\dsl\query\fulltext;


class SimpleQueryStringQuery extends FullTextQuery {

    protected $query_type = 'simple_query_string';

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}
