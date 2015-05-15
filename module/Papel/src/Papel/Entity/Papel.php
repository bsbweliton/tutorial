<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */
namespace Papel\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Rbac\Role\HierarchicalRoleInterface;
use ZfcRbac\Permission\PermissionInterface;
use Zend\Form\Annotation as Form;

/**
 * @ORM\Entity
 * @ORM\Table(name="papel")
 * @Form\Name("formPapel")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("LosBase\Form\AbstractForm")
 */
class Papel implements HierarchicalRoleInterface
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Form\Exclude()
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=48, unique=true)
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":3, "max":10}})
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Nome"}) 
     */
    protected $name;

    /**
     * @var HierarchicalRoleInterface[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Papel")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     * @ORM\OrderBy({"name" = "ASC"}) 
     * @Form\Options({"label":"Papéis filhos", "target_class":"Papel\Entity\Papel","find_method":{"name":"findBy","params":{"criteria":{}, "orderBy":{"name":"ASC"}}},"display_empty_item":true,"empty_item_label":"---"})
     * @Form\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Form\Attributes({"multiple":"multiple"})
     * @Form\Required(false)  
     */
    protected $children;

    /**
     * @var PermissionInterface[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Permission", indexBy="name", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @ORM\OrderBy({"name" = "ASC"}) 
     * @Form\Options({"label":"Permissões", "target_class":"Papel\Entity\Permission","find_method":{"name":"findBy","params":{"criteria":{}, "orderBy":{"name":"ASC"}}},"display_empty_item":true,"empty_item_label":"---"})
     * @Form\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Form\Attributes({"multiple":"multiple"})
     * @Form\Required(true) 
     */
    protected $permissions;

    /**
     * Init the Doctrine collection
     */
    public function __construct()
    {
        $this->children    = new ArrayCollection();
        $this->permissions = new ArrayCollection();
    }
    
    public function __toString()
    {
    	return $this->name;
    }  
    
    /**
     * Set the role identifier
     *
     * @param int $id
     */
    public function setId($id)
    {
    	$this->id = $id;
    
    	return $this;
    }    

    /**
     * Get the role identifier
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the role name
     *
     * @param  string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * Get the role name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    

    /**
     * {@inheritDoc}
     */
    public function addChildren(HierarchicalRoleInterface $child)
    {
    	$child = new Papel($child);
    	$this->children[(string) $child] = $child;
        //$this->children[] = $child;
    }
    
    /**
     * {@inheritDoc}
     */
    public function removeChildren(HierarchicalRoleInterface $child)
    {    	
    	$this->children->remove[(string) $child];
    	//$this->children[] = $child;
    }
    
    /**
     * {@inheritDoc}
     */
    public function removePermissions($permission)
    {
    	$this->permissions->remove((string) $permission);
    }
    /**
     * {@inheritDoc}
     */
    public function addPermissions($permission)
    {
        if (is_string($permission)) {
            $permission = new Permission($permission);
        }

        $this->permissions[(string) $permission] = $permission;
    }
    /**
     * Get the role permissions
     *
     * @return PermissionInterface[]
     */    
    public function getPermissions()
    {
    	return $this->permissions;
    }    
    
    public function setPermissions($permissions)
    {
    	$this->permissions = $permissions;
    }     

    /**
     * {@inheritDoc}
     */
    public function hasPermission($permission)
    {
        // This can be a performance problem if your role has a lot of permissions. Please refer
        // to the cookbook to an elegant way to solve this issue

        return isset($this->permissions[(string) $permission]);
    }

    /**
     * {@inheritDoc}
     */
    public function getChildren()
    {    	
        return $this->children;
    }

    /**
     * {@inheritDoc}
     */
    public function hasChildren()
    {
        return !$this->children->isEmpty();
    }
}
