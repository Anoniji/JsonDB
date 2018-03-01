# JsonDB - Open Project
![alt text](https://anoniji.com/img/JsonDB.png)
JsonDB été un projet de Base de Données en Json.

# Fonctionnement
- 1- Installer Composer
- 2- Ajouter :

```php
require __DIR__ . '/vendor/autoload.php';
$Connect = new \JsonDB\Connect($db = "site");
$Functions = new \JsonDB\Functions();
echo $Connect->Jtb("test", array("pseudo" => "string", "date" => "int"));
```

# Fonctions disponibles

## Connect

> Insert
```php
$Connect->Insert("users", array("test", date("dmY")));
```

> Select

- One

	```php
	$user = $Connect->Select("users", "pseudo", "=", "test");
	echo $user["pseudo"]." - ";
	echo $user["date"];
	```

- All

	```php
	print_r($Connect->Select("users", "pseudo", "=", "test", "all"));
	```

> Update
```php
$Connect->Update("users", "pseudo", "test", array("date" => "test"));
```

> Display Error
```php
echo $Connect->getError();
```

## Functions

> Password
```php
$Functions->Password("password", 030120181301);
```

> Filter
```php
$Functions->Filter($array, "date", "desc");
```

> Check

> Protect

> Display Error
```php
echo $Functions->getError();
```