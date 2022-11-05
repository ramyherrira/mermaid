<?php

namespace Herrira\Mermaid\ClassDiagram;

class MethodDefinition
{
    protected $name;

    protected $parameters;

    protected $returnType;

    protected $visibility;

    public function __construct($name, $parameters = [], $returnType = '', $visibility = '')
    {
        $this->name = $name;
        $this->parameters = $parameters;
        $this->returnType = $returnType;
        $this->visibility = $visibility;
    }

    public function generate(): string
    {
        $implodedParams = implode(', ', $this->parameters);
        $return = !empty($this->returnType) ? " {$this->returnType}" : '';

        return "{$this->visibility}{$this->name}({$implodedParams}){$return}";
    }
}