<?php

namespace App\Entity;

use App\Entity\Customer\UserAdress;
use App\Entity\Order\OrderDetails;
use App\Entity\Order\ShoppingSession;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;


    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserAdress::class)]
    private Collection $userAdresses;


    #[ORM\Column()]
    private ?DateTimeImmutable $created_at = null;

    #[ORM\Column()]
    private ?DateTimeImmutable $modified_at = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ShoppingSession::class)]
    private Collection $shoppingSessions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: OrderDetails::class)]
    private Collection $orderDetails;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    public function __construct()
    {
        $this->userAdresses = new ArrayCollection();
        $this->shoppingSessions = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }





    /**
     * @return Collection<int, UserAdress>
     */
    public function getUserAdresses(): Collection
    {
        return $this->userAdresses;
    }

    public function addUserAdress(UserAdress $userAdress): self
    {
        if (!$this->userAdresses->contains($userAdress)) {
            $this->userAdresses->add($userAdress);
            $userAdress->setUser($this);
        }

        return $this;
    }

    public function removeUserAdress(UserAdress $userAdress): self
    {
        if ($this->userAdresses->removeElement($userAdress)) {
            // set the owning side to null (unless already changed)
            if ($userAdress->getUser() === $this) {
                $userAdress->setUser(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?DateTimeImmutable
    {
        return $this->modified_at;
    }

    public function setModifiedAt(DateTimeImmutable $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    /**
     * @return Collection<int, ShoppingSession>
     */
    public function getShoppingSessions(): Collection
    {
        return $this->shoppingSessions;
    }


    public function addShoppingSession(ShoppingSession $shoppingSession): self
    {
        if (!$this->shoppingSessions->contains($shoppingSession)) {
            $this->shoppingSessions->add($shoppingSession);
            $shoppingSession->setUser($this);
        }

        return $this;
    }

    public function removeShoppingSession(ShoppingSession $shoppingSession): self
    {
        if ($this->shoppingSessions->removeElement($shoppingSession)) {
            // set the owning side to null (unless already changed)
            if ($shoppingSession->getUser() === $this) {
                $shoppingSession->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderDetails>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetails $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->add($orderDetail);
            $orderDetail->setUser($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetails $orderDetail): self
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getUser() === $this) {
                $orderDetail->setUser(null);
            }
        }

        return $this;
    }

    public  function __toString(): string
    {
        return $this->name . " " . $this->surname;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }
}
