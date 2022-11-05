<?php

namespace Herrira\Mermaid\ClassDiagram;

class Builder
{
    protected $expressions = [];

    public function class($name): self
    {
        if ($name instanceof \Closure) {
            $name($class = new ClassDefinition($name));
            $this->expressions[] = $class->generate();
        } else {
            $this->expressions[] = "class {$name}\n";
        }

        return $this;
    }

    public function attribute($class, $name, $type, $visibility = ''): self
    {
        $expression = new AttributeDefinition($name, $type, $visibility, $class);
        $this->expressions[] = $expression->generate() . PHP_EOL;

        return $this;
    }

    public function publicAttribute($class, $name, $type): self
    {
        return $this->attribute($class, $name, $type, '+');
    }

    public function protectedAttribute($class, $name, $type): self
    {
        return $this->attribute($class, $name, $type, '#');
    }

    public function privateAttribute($class, $name, $type): self
    {
        return $this->attribute($class, $name, $type, '-');
    }

    public function method($class, $name, $parameters = [], $return = null, $visibility = '')
    {
        $this->expressions[] = $class . ': ' . $visibility . $name . '(' .
            implode(', ', $parameters) . ')' .
            ($return ? ' ' . $return : '') . PHP_EOL;

        return $this;
    }

    public function publicMethod($class, $name, $parameters = [], $return = null)
    {
        return $this->method($class, $name, $parameters, $return, '+');
    }

    public function protectedMethod($class, $name, $parameters = [], $return = null)
    {
        return $this->method($class, $name, $parameters, $return, '#');
    }

    public function privateMethod($class, $name, $parameters = [], $return = null)
    {
        return $this->method($class, $name, $parameters, $return, '-');
    }

    public function annotation($class, $annotation): self
    {
        $this->expressions[] = "<<{$annotation}>> $class" . PHP_EOL;

        return $this;
    }

    public function generate(): string
    {
        $header =  'classDiagram' . PHP_EOL;

        return $header . implode($this->expressions);
    }

    public function inheritance($class, $parent): self
    {
        $relation = new RelationDefinition('inheritance', $class, $parent);
        $this->expressions[] = $relation->generate() . PHP_EOL;

        return $this;
    }

    public function composition($classA, $classB): self
    {
        $relation = new RelationDefinition('composition', $classA, $classB);
        $this->expressions[] = $relation->generate() . PHP_EOL;

        return $this;
    }

    public function aggregation($classA, $classB): self
    {
        $relation = new RelationDefinition('aggregation', $classA, $classB);
        $this->expressions[] = $relation->generate() . PHP_EOL;

        return $this;
    }

    public function association($classA, $classB): self
    {
        $relation = new RelationDefinition('association', $classA, $classB);
        $this->expressions[] = $relation->generate() . PHP_EOL;

        return $this;
    }

    public function link($classA, $classB): self
    {
        $relation = new RelationDefinition('link', $classA, $classB);
        $this->expressions[] = $relation->generate() . PHP_EOL;

        return $this;
    }

    public function dependency($classA, $classB): self
    {
        $relation = new RelationDefinition('dependency', $classA, $classB);
        $this->expressions[] = $relation->generate() . PHP_EOL;

        return $this;
    }

    public function realization($classA, $classB): self
    {
        $relation = new RelationDefinition('realization', $classA, $classB);
        $this->expressions[] = $relation->generate() . PHP_EOL;

        return $this;
    }

    public function dashedLink($classA, $classB): self
    {
        $relation = new RelationDefinition('dashedLink', $classA, $classB);
        $this->expressions[] = $relation->generate() . PHP_EOL;

        return $this;
    }
}
