# elastic-dsl 

A DSL-Query builder for Elasticsearch

## Future usage
```php
use elastic\dsl\query\QueryBuilder;
use elastic\dsl\query\fulltext\QueryStringQuery;

$query = new QueryBuilder();

$query->addTerm("user", "kimchy");
$query->addShouldQuery(new QueryStringQuery('*', 'quick brown fox'));
$query->orderBy("user", "DESC");
$query->limit(15);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'localhost:9200/_search',
    CURLOPT_POSTFIELDS => $query->toString()
));

$response = curl_exec($curl);

curl_close($curl);
```

## Todo
 + Query-builder for Query DSL
 + Aggregation-builder
 + Mapping-builder
 + Suggest-builder

## Licence 

MIT