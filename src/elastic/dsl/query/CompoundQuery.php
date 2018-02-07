<?php namespace elastic\dsl\query;


/**
 * Compound query clauses wrap other leaf or compound queries
 * and are used to combine multiple queries in a logical fashion
 * (such as the bool or dis_max query),
 * or to alter their behaviour (such as the constant_score query).
 *
 * @package elastic\dsl\query
 */
abstract class CompoundQuery extends AbstractQuery {

}