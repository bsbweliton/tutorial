<?php
namespace Documento\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use LosBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="autoridade_receptor")
 */
class AutoridadeReceptor extends AbstractEntity
{
	/**
	 * @var int|null
	 *
	 * @ORM\Id
	 * @ORM\Column(name="id_autoridade_receptor", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @Form\Exclude()
	 */

	protected $id;
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=250)
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"nomeautoridade"})
	 * @Form\Options({"label":"Nome Autoridade"})
	 */
	
	protected $nomeautoridade;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=250)
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"cargoautoridade"})
	 * @Form\Options({"label":"Cargo Autoridade"})
	 */
	
	protected $cargoautoridade;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=1)
	 * @Form\Type("Zend\Form\Element\Select")
	 * @Form\Attributes({"class":"form-control", "id":"genero"})
	 * @Form\Options({"label":"Gênero", "value_options":{
	 * 		"m":"Masculino",
	 * 		"f":"Feminino",
	 * 		"n":"Não informar"
	 * 		}
	 * 	})
	 */
	
	protected $genero;

	/**
	 * @var int|null
	 *
	 * @ORM\OneToOne(targetEntity="Documento\Entity\Receptor")
	 * @ORM\JoinColumn(nullable=true, onDelete="CASCADE", referencedColumnName="id_receptor")
	 * @ORM\OrderBy({"nome" = "ASC"})
	 * @Form\Exclude()
	 */
	
	protected $id_receptor;	
	
	/**
	 * @var int|null
	 * 
	 * @ORM\OneToOne(targetEntity="Documento\Entity\EnderecoDestino")
	 * @ORM\JoinColumn(nullable=false, onDelete="CASCADE", referencedColumnName="id_endereco_destino")
	 * @ORM\OrderBy({"nome" = "ASC"})
	 * @Form\ComposedObject("Documento\Entity\EnderecoDestino")
	 * @Form\Attributes({"type":"hidden"})
	 */
	
	protected $autoridadeEnderecoDestino;	
	
}
