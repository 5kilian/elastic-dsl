<?php namespace elastic\dsl\query;


abstract class AbstractQuery {

    public abstract function toArray();

    public function toString() {
        return json_encode($this->toArray());
    }

}
