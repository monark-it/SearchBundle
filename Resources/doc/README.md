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


4. Execute the insert query

```php
    $builder = new Builder();
             $query = $builder->build([
               Product::class => ['libelle' => 'lib1','prix' => 123]
            ]);

             $sm->insert($query);
```

5. Execute the update query

```php
   $builder = new Builder();
            $query = $builder->build([
                Product::class => ['id' =>15,'prix' => 499]
            ]);

            $sm->update($query);
```

6. Execute the delete query

```php
    $builder = new Builder();
          $query = $builder->build([
              Product::class => ['id' =>15]
          ]);

          $sm->remove($query);
```