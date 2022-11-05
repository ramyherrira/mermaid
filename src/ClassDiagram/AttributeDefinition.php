<?php

namespace Herrira\Mermaid\ClassDiagram;

class AttributeDefinition
{
    protected $name;
    protected $type;
    protected $visibility;
    protected $class;

    public function __construct($name, $type = '', $visibility = '', $class = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->visibility = $visibility;
        $this->class = $class;
    }

    public function generate(): string
    {
        $prefix = '';
        if (!empty($this->class)) {
            $prefix = "{$this->class} : ";
        }
        if (!empty($this->visibility)) {
            $prefix = "$prefix{$this->visibility}";
        }
        if (!empty($this->type)) {
            $prefix = "{$prefix}{$this->type} ";
        }

        return "{$prefix}$this->name";
    }
}