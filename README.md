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
$Connect->Insert(array("test", date("dmY")));
```

> Select

#### One

	```php
	$user = $Connect->Select("pseudo", "=", "test");
	echo $user["pseudo"]." - ";
	echo $user["date"];
	```

#### All

	```php
	print_r($Connect->Select("pseudo", "=", "test", "all"));
	```

> Update
```php
$Connect->Update("pseudo", "test", array("date" => "test"));
```

> Delete
```php
$Connect->Delete("pseudo", "=", "test");
```

> Display Error
```php
echo $Connect->getError();
```

## Functions

> Password
```php
$Functions->Password("password", 030120181301, "md5");
```
or
```php
$Functions->Password("password", 030120181301, "crypt");
```


> Filter
```php
$Functions->Filter($array, "date", "desc");
```

> Protect
```php
echo $Functions->Protect("<?= $test; ?>");
```

> Display Error
```php
echo $Functions->getError();
```

### Check

> isMail
```php
if($Functions->isMail("test@me.com"))
  echo "OK";
else
  else "NO";
```

> isLink
```php
if($Functions->isLink("http://test.com"))
  echo "OK";
else
  else "NO";

```

> isIp
```php
if($Functions->isIp("127.0.0.1"))
  echo "OK";
else
  else "NO";

```