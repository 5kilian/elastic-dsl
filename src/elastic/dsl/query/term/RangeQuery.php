<?php namespace elastic\dsl\query\term;


/**
 *
 *
 * @package elastic\dsl\query\term
 */
class RangeQuery extends TermLevelQuery {

    /**
     * @var string
     */
    public $field;

    /**
     * Greater-than or equal to
     *
     * @var mixed
     */
    public $gte = null;

    /**
     * Greater-than
     *
     * @var mixed
     */
    public $gt = null;

    /**
     * Less-than or equal to
     *
     * @var mixed
     */
    public $lte = null;

    /**
     * Less-than
     *
     * @var mixed
     */
    public $lt = null;

    /**
     * Sets the boost value of the query, defaults to 1.0
     *
     * @var double
     */
    public $boost = 1.0;

    /**
     * Formatted dates will be parsed using the format specified
     * on the date field by default, but it can be overridden
     * by passing the format parameter.
     *
     * @var string
     */
    public $format = null;

    public function __construct($field, $lte=null, $gte=null, $format=null) {
        $this->field = $field;
        $this->gte = $gte;
        $this->lte = $lte;
        $this->format = $format;
    }

    public function gte($value) {
        $this->gte = $value;
        return $this;
    }

    public function gt($value) {
        $this->gt = $value;
        return $this;
    }

    public function lte($value) {
        $this->lte = $value;
        return $this;
    }

    public function lt($value) {
        $this->lt = $value;
        return $this;
    }

    public function format($value) {
        $this->format = $value;
        return $this;
    }

    public function boost($value) {
        $this->boost = $value;
        return $this;
    }

    public function toArray() {
        $query = [];

        if (isset($this->gte)) $query['gte'] = $this->gte;
        if (isset($this->gt)) $query['gt'] = $this->gt;
        if (isset($this->lte)) $query['lte'] = $this->lte;
        if (isset($this->lt)) $query['lt'] = $this->lt;
        if ($this->boost !== 1) $query['boost'] = $this->boost;

        return [ "range" => [ $this->field => $query ] ];
    }

}
