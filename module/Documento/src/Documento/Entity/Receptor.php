<?php
namespace Documento\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use LosBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="receptor")
 */
class Receptor extends AbstractEntity
{
	/**
	 * @var int|null
	 *
	 * @ORM\Id
	 * @ORM\Column(name="id_receptor", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @Form\Exclude()
	 */

	protected $id;
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=200)
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"nomeentidade"})
	 * @Form\Options({"label":"Nome Entidade"})
	 */
	
	protected $nomeentidade;	
	
	/**
	 * @var int|null
	 * 
	 * @ORM\OneToOne(targetEntity="Documento\Entity\EnderecoDestino", fetch="EAGER")
	 * @ORM\JoinColumn(nullable=false, onDelete="CASCADE", referencedColumnName="id_endereco_destino")
	 * @ORM\OrderBy({"nome" = "ASC"})
	 * @Form\ComposedObject("Documento\Entity\EnderecoDestino")
	 * @Form\Attributes({"type":"hidden"})
	 */
	
	protected $receptorEnderecoDestino;	
}
