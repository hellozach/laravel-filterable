#Installation

##1. Require the package

```
composer require urbananalog/nwmls
```

##2. Use the Filterable trait

Add the following line to the filterable model

```php
use HelloZach\LaravelFilterable\Traits\Filterable;
```

And add the trait to the class:

```php
use Filterable;
```

##3. Add filterable columns to model

Add an array of columns that are filterable for the model:

```php
protected $filterable = [
    // Column names
];
```

##4. Add filterable casts (options)

Map column names to methods in the model class

```php
protected $filterableCasts = [
    // 'column_name' => 'method_name'
];
```