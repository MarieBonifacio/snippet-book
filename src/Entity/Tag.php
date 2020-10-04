<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @var ArrayCollection<int,Snippet>
     * @ORM\ManyToMany(targetEntity=Snippet::class, mappedBy="tags")
     */
    private ArrayCollection $snippets;

    public function __construct()
    {
        $this->snippets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int,Snippet>
     */
    public function getSnippets(): Collection
    {
        return $this->snippets;
    }

    public function addSnippet(Snippet $snippet): self
    {
        if (!$this->snippets->contains($snippet)) {
            $this->snippets[] = $snippet;
            $snippet->addTag($this);
        }

        return $this;
    }

    public function removeSnippet(Snippet $snippet): self
    {
        if ($this->snippets->contains($snippet)) {
            $this->snippets->removeElement($snippet);
            $snippet->removeTag($this);
        }

        return $this;
    }
}
