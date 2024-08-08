<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Pizza>
     */
    #[ORM\OneToMany(targetEntity: Pizza::class, mappedBy: 'category_id')]
    private Collection $pizzas;

    /**
     * @var Collection<int, Pizza>
     */
    #[ORM\OneToMany(targetEntity: Pizza::class, mappedBy: 'category')]
    private Collection $pizzas2;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
        $this->pizzas2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): static
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas->add($pizza);
            $pizza->setCategoryId($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): static
    {
        if ($this->pizzas->removeElement($pizza)) {
            // set the owning side to null (unless already changed)
            if ($pizza->getCategoryId() === $this) {
                $pizza->setCategoryId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizzas2(): Collection
    {
        return $this->pizzas2;
    }

    public function addPizzas2(Pizza $pizzas2): static
    {
        if (!$this->pizzas2->contains($pizzas2)) {
            $this->pizzas2->add($pizzas2);
            $pizzas2->setCategory($this);
        }

        return $this;
    }

    public function removePizzas2(Pizza $pizzas2): static
    {
        if ($this->pizzas2->removeElement($pizzas2)) {
            // set the owning side to null (unless already changed)
            if ($pizzas2->getCategory() === $this) {
                $pizzas2->setCategory(null);
            }
        }

        return $this;
    }
}
