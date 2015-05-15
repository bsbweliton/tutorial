<?php
namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use ZfcUser\Entity\UserInterface as ZfcUserInterface;
use ZfcRbac\Identity\IdentityInterface;
use LosBase\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 * @Form\Name("formUsuario")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("LosBase\Form\AbstractForm")
 */
class Usuario extends AbstractEntity implements ZfcUserInterface, IdentityInterface
{

    /**
     * @ORM\Column(type="string", length=250)
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":3, "max":250}})
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Nome"})
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=255)
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":255}})
     * @Form\Attributes({"type":"email"})
     * @Form\Options({"label":"Email"})
     */
    protected $email = '';

    /**
     * @ORM\ManyToOne(targetEntity="Cliente\Entity\Cliente", inversedBy="usuarios")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     * @ORM\OrderBy({"nome" = "ASC"})
     * @Form\Options({"label":"Cliente", "target_class":"Cliente\Entity\Cliente","find_method":{"name":"findBy","params":{"criteria":{}, "orderBy":{"nome":"ASC"}}},"display_empty_item":true,"empty_item_label":"---"})
     * @Form\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Form\Required(false)
     */
    protected $cliente;
    
    /**
     * @ORM\ManyToOne(targetEntity="Papel\Entity\Papel", inversedBy="usuario")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     * @ORM\OrderBy({"name" = "ASC"})
     * @Form\Options({"label":"Papel", "target_class":"Papel\Entity\Papel","find_method":{"name":"findBy","params":{"criteria":{}, "orderBy":{"name":"ASC"}}},"display_empty_item":true,"empty_item_label":"---"})
     * @Form\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Form\Required(false)
     */    
    protected $papel = 3;

    protected $username;

    /**
     * @ORM\Column(type="string", length=128)
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":128}})
     * @Form\Attributes({"type":"password"})
     * @Form\Options({"label":"Senha"})
     */
    protected $password = '';

    /**
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":3, "max":32}})
     * @Form\Validator({"name":"Identical", "options":{"token":"password", "message":"As senhas não combinam"}})
     * @Form\Attributes({"type":"password"})
     * @Form\Options({"label":"Confirme a Senha"})
     */
    protected $confirmesenha;

    /**
     * @ORM\OneToMany(targetEntity="Usuario\Entity\Acesso", mappedBy="usuario")
     * @ORM\JoinColumn(nullable=false)
     * @Form\Exclude()
     */
    protected $acessos;

    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
        $this->acessos = new ArrayCollection();
    }

    /**
     * @return string the $nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Retorna o campo $papel
     * @return $papel
     */
    public function getPapel()
    {
        return $this->papel;
    }

    /**
     * Seta o campo $papel
     * @param  field_type $papel
     * @return $this
     */
    public function setPapel($papel)
    {
        $this->papel = $papel;

        return $this;
    }

    public function getRoles()
    {
        return array(
            $this->papel
        );
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getDisplayName()
    {
        return $this->getNome();
    }

    public function setDisplayName($displayName)
    {}

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (! empty($password)) {
            $this->password = (string) $password;
        }
    }

    public function getState()
    {}

    public function setState($state)
    {}

    public function getConfirmesenha()
    {
        return $this->confirmesenha;
    }

    public function setConfirmesenha($confirmesenha)
    {
        $this->confirmesenha = $confirmesenha;

        return $this;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getAcessos()
    {
        return $this->acessos;
    }

    public function setAcessos($acessos)
    {
        $this->acessos = $acessos;

        return $this;
    }

    public function addAcessos(Collection $acessos)
    {
        foreach ($acessos as $acesso) {
            $acesso->setUsuario($this);
            $this->acessos->add($acesso);
        }
    }

    public function removeAcessos(Collection $acessos)
    {
        foreach ($acessos as $acesso) {
            $this->acessos->removeElement($acesso);
        }
    }

    public function addAcesso($acesso)
    {
        foreach ($this->acessos as $tok) {
            if ($tok->getId() == $acesso->getId()) {
                return $this;
            }
        }
        $this->acessos[] = $acesso;
        return $this;
    }

    public function __toString()
    {
        return $this->getDisplayName();
    }
}
