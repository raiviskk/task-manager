<?php

namespace App\Models;

use Carbon\Carbon;

class Task
{
    private string $name;
    private string $description;
    private Carbon $createdAt;
    private ?int $id;

    public function __construct(
        string $name,
        string $description,
               $createdAt = null, // Allow null or Carbon
        ?int $id = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->id = $id;

        if ($createdAt instanceof Carbon) {
            $this->createdAt = $createdAt;
        } else {
            $this->createdAt = $createdAt === null ? Carbon::now() : new Carbon($createdAt);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

}