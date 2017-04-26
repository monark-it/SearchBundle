1. Prepare the query

```php
$builer = new MIT\Bundle\SearchBundle\Query\Builder();
$query = $builder->build([
    Organization::class => ['name' => 'est'],
    User::class => ['username' => 'admin'],
    Notification::class => ['message' => 'test']
]);

```

2. Get The search manager

```php
$sm = $this->container->get("mit_search.search_manager");
```

3. Execute the search query

```php
// array
$result = $sm->search($query);
```
