<?php


namespace App\Model\Parents;


class Item
{
    protected ?object $entity;
    protected string $name;

    public function __construct(?object $entity)
    {
        $this->entity = $entity;
    }
    public function setName()
    {
        $this->name = $this->entity->getBase()->getName();
    }
    public function getName(): string
    {
        return $this->name;
    }
}