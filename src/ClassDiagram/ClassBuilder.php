<?php

namespace Herrira\Mermaid\ClassDiagram;

class ClassBuilder
{
    /** @var string */
    protected $name;

    /** @var array */
    protected $expressions;

    public function __construct($name  = '')
    {
        $this->name = $name;
        $this->expressions = [];
    }

    public function generate()
    {
        if (count($this->expressions) === 0) {
            return "class {$this->name}\n";
        }

        return "class {$this->name} {\n" .
            implode(PHP_EOL, $this->expressions) .
            "\n}\n";
    }

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    public function attribute($name, $type, $visibility = '')
    {
        $this->expressions[] = (new AttributeDefinition(...func_get_args()))->generate();

        return $this;
    }

    public function publicAttribute($name, $type)
    {
        return $this->attribute($name, $type, '+');
    }

    public function protectedAttribute($name, $type)
    {
        return $this->attribute($name, $type, '#');
    }

    public function privateAttribute($name, $type)
    {
        return $this->attribute($name, $type, '-');
    }

    public function method($name, $parameters = [], $returnType = '', $visibility = '')
    {
        $this->expressions[] = (new MethodDefinition(...func_get_args()))->generate();

        return $this;
    }

    public function publicMethod($name, $parameters =  [], $returnType = '')
    {
        return $this->method($name, $parameters, $returnType, '+');
    }

    public function protectedMethod($name, $parameters = [], $returnType = '')
    {
        return $this->method($name, $parameters, $returnType, '#');
    }

    public function privateMethod($name, $parameters = [], $returnType = '')
    {
        return $this->method($name, $parameters, $returnType, '-');
    }

    public function annotation($type)
    {
        $this->expressions[] = "<<{$type}>>";

        return $this;
    }
}
