# Guia projecte PHP Bàsic (Windows)

## Introducció

Aquest document descriu com preparar un entorn de desenvolupament PHP en Windows i crear una aplicació web senzilla.

El cas d’ús consisteix en mostrar un missatge en funció de l’idioma, ja sigui indicat per URL o detectat automàticament des del navegador.

---

## Plantejament

Per aquest exemple s’ha optat per una solució lleugera i sense frameworks, amb l’objectiu de:

* Minimitzar la configuració
* Facilitat de manteniment

---

## Requisits mínims

* Sistema operatiu Windows
* PHP 8 o superior
* Terminal (PowerShell o CMD)
* Navegador web
* Git

---

## Instal·lació de l’entorn

### Instal·lar PHP a Windows

Podem descarregar PHP des de la web oficial.

Ens descarreguem l’última versió disponible en format `.zip` (per exemple, PHP 8.5.4), preferiblement la versió **Non Thread Safe**, ja que és la més recomanada.

A continuació, extraiem el contingut en una ruta del sistema, per exemple:

```
C:\php-8.5.4
```

Un cop fet això, cal afegir aquesta ruta al **PATH de Windows**. Per fer-ho, podem anar a “Editar les variables d’entorn” des del menú d’inici.

Només cal afegir una nova entrada a les variables d’entorn de l’usuari amb el valor:

```
C:\php-8.5.4
```

Finalment, verificarem que PHP s’ha instal·lat correctament obrint una terminal (CMD o PowerShell) i executant:

```bash
php -v
```

Si tot ha anat bé, hauria d’aparèixer la versió de PHP instal·lada.

---

## Control de versions

Tot i que no és necessari, es recomana treballar amb control de versions.

Podem descarregar Git des de la web oficial.

---

## Creació del projecte

Crearem una carpeta per començar el projecte:

```bash
mkdir php-lang-demo
cd php-lang-demo
```

Inicialitzem el repositori Git:

```bash
git init
```

Creem el punt d’entrada de l’aplicació:

```bash
type nul > index.php
```

---

## Execució local

PHP disposa d’un servidor integrat que permet executar aplicacions sense configuracions addicionals:

```bash
php -S localhost:8000
```

Accés:

```
http://localhost:8000
```

Aquest enfocament evita dependències amb Apache/Nginx i és suficient per al desenvolupament inicial.

---

## Implementació

La lògica segueix aquest ordre de prioritat:

1. Paràmetre `lang` a la URL
2. Idioma del navegador
3. Valor per defecte

---

## Codi del punt d’entrada (`index.php`)

```php
<?php

$lang = 'ca';

if (!empty($_GET['lang'])) {
    $lang = $_GET['lang'];
} elseif (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

$translations = [
    'ca' => 'Hola món',
    'es' => 'Hola mundo',
    'en' => 'Hello World'
];

$text = $translations[$lang] ?? $translations['ca'];

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Demo PHP</title>
</head>
<body>
    <main>
        <h1><?= $text ?></h1>
    </main>
</body>
</html>
```

---

## Validació

Exemples de prova:

* `/?lang=ca`
* `/?lang=es`
* `/?lang=en`

Sense paràmetre, el comportament dependrà de la configuració del navegador.

---

## Estructura del repositori

```
php-lang-demo/
├── index.php
└── README.md
```

---

## Commits inicials

```bash
git add .
git commit -m "Base PHP project with language detection"
```

---

## Evolució del projecte

En un escenari real, aquest punt de partida es podria ampliar amb:

* Fitxers de traducció externs
* Tests automatitzats
* Integració amb frameworks com Laravel

---

## Tancament

Aquest enfocament permet iniciar ràpidament un projecte PHP mantenint una base clara i escalable, especialment útil en fases inicials o entorns de manteniment.
