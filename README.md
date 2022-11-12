# Mermaid syntax generator for PHP
A PHP library that enables to you generate mermaid-js syntax.

### Available diagrams:
 - Class diagram


## What's mermaid ?
From the [docs](https://mermaid-js.github.io/mermaid/#/):
> It is a JavaScript based diagramming and charting tool that renders Markdown-inspired text definitions to create and modify diagrams dynamically.

You can also use it in [Github's markdown](https://github.blog/2022-02-14-include-diagrams-markdown-files-mermaid/).

## Installation
You can install the package via composer:
```
composer require herrira/mermaid
```

## Use:

```php
use Herrira\Mermaid\ClassDiagram\Builder;

$builder = new Builder();
$builder->inheritance('Duck', 'Animal')
    ->inheritance('Fish', 'Animal')
    ->inheritance('Zebra', 'Animal')
    ->publicAttribute('Animal', 'age', 'int')
    ->publicAttribute('Animal', 'gender', 'String')
    ->publicMethod('Animal', 'isMammal')
    ->publicMethod('Animal', 'mate')
    ->class(function ($class) {
        $class->name('Duck')
            ->publicAttribute('beakColor', 'String')
            ->publicMethod('swim')
            ->publicMethod('quack');
    })
    ->class(function ($class) {
        $class->name('Fish')
            ->privateAttribute('sizeInFeet', 'int')
            ->privateMethod('canEat');
    })
    ->class(function ($class) {
        $class->name('Zebra')
            ->publicAttribute('is_wild', 'bool')
            ->publicMethod('run');
    });

```
Will result in:

```markdown
classDiagram
Animal <|-- Duck
Animal <|-- Fish
Animal <|-- Zebra
Animal : +int age
Animal : +String gender
Animal: +isMammal()
Animal: +mate()
class Duck{
+String beakColor
+swim()
+quack()
}
class Fish{
-int sizeInFeet
-canEat()
}
class Zebra{
+bool is_wild
+run()
}
```

**Note:** *Indentation support will be available in future versions.*