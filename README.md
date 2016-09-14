lib-php-classmark
====================

[![Latest Stable Version](https://poser.pugx.org/unikent/lib-php-classmark/v/stable.png)](https://packagist.org/packages/unikent/lib-php-classmark)
[![StyleCI](https://styleci.io/repos/64657137/shield)](https://styleci.io/repos/64657137)

Full API docs available here: http://unikent.github.io/lib-php-classmark/

PHP library for helping developers with classmarks

Add this to your composer require:
 * "unikent/lib-php-classmark": "dev-master"

Then get lists like so:
```
$parser = new \unikent\Classmark\Classmark();

$classmark = new \unikent\Classmark\Classmark("C900x");
$classmark2 = new \unikent\Classmark\Classmark("C800x");

if ($classmark.compareTo(classmark2)) {
    echo "Well done!";
}
```
