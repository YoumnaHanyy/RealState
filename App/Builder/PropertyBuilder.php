<?php
namespace App\Builder;
class PropertyBuilder {
    private array $data = [];

    public function setName(string $name): self {
        $this->data['name'] = $name;
        return $this;
    }

    public function setPrice(float $price): self {
        $this->data['price'] = $price;
        return $this;
    }

    public function setDeveloper(string $developer): self {
        $this->data['developer'] = $developer;
        return $this;
    }

    public function setLocation(string $location): self {
        $this->data['location'] = $location;
        return $this;
    }

    public function setImage(string $image): self {
        $this->data['image'] = $image;
        return $this;
    }

    public function setCreatedBy(string $user): self {
        $this->data['created_by'] = $user;
        return $this;
    }

    public function build(): array {
        return $this->data;
    }
}
