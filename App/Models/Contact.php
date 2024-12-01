<?php

declare(strict_types=1);

namespace App\Models;

class Contact implements \JsonSerializable
{

    private int $id;
    private string $name;
    private string $phone;
    private string $email;
    private string $annotations;
    private string $photo;

    public function __construct()
    {
    }

    public function jsonSerialize(): mixed
    {
        $vars = get_object_vars($this);
        return $vars;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
    
    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getAnnotations(): string
    {
        return $this->annotations;
    }

    public function setAnnotations(string $annotations)
    {
        $this->annotations = $annotations;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }

}