# JsonDB - Open Project
JsonDB été un projet de Base de Données en Json.

# Fonctionnement
- 1- Installer Composer
- 2- Ajouter :
>require __DIR__ . '/vendor/autoload.php';
>$Connect = new \JsonDB\Connect($db = "site");
>echo $Connect->Jtb("test", array("pseudo" => "string", "date" => "int"));

# Fonctions disponibles

> Insert
$Connect->Insert("users", array("test", date("dmY")));

> Select
	- One
	$user = $Connect->Select("users", "pseudo", "=", "test");
	echo $user["pseudo"]." - ";
	echo $user["date"];

	- All
	print_r($Connect->Select("users", "pseudo", "=", "test", "all"));

> Update
$Connect->Update("users", "pseudo", "test", array("date" => "test"));

> Display Error
echo $Connect->getError();