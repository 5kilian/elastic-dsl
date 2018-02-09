<?php namespace elastic\dsl\query\term;


/**
 * Find documents which contain any of the exact terms specified in the field specified.
 *
 * @package elastic\dsl\query\term
 */
class TermsQuery extends TermLevelQuery {

    /**
     * @var string
     */
    public $field;

    /**
     * @var array
     */
    public $values;

    /**
     * The index to fetch the term values from.
     *
     * @var string
     */
    public $index = null;

    /**
     * The type to fetch the term values from.
     *
     * @var string
     */
    public $type = null;

    /**
     * The id of the document to fetch the term values from.
     *
     * @var string
     */
    public $id = null;

    /**
     * The field specified as path to fetch the actual values for the terms filter.
     *
     * @var string
     */
    public $path = null;

    /**
     * A custom routing value to be used when retrieving the external terms doc.
     *
     * @var string
     */
    public $routing = null;

    public function __construct($field, $values = []) {
        $this->field = $field;
        $this->values = $values;
    }

    public function toArray() {
        $query = [];

        if (isset($this->index)) $query['index'] = $this->index;
        if (isset($this->type)) $query['type'] = $this->type;
        if (isset($this->id)) $query['id'] = $this->id;
        if (isset($this->path)) $query['path'] = $this->path;
        if (isset($this->routing)) $query['routing'] = $this->routing;
        if (!empty($query) && !empty($this->values)) $query['terms'] = $this->values;
        else $query = $this->values;

        return [ "query" => [ $this->field => $query ] ];
    }

}