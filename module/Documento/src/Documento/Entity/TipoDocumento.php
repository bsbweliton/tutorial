<?php
namespace Documento\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use LosBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="tipo_documento")
 */
class TipoDocumento extends AbstractEntity
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
	 * @ORM\Column(type="string", length=30)
	 */
	
	protected $nome_tipo;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=200)
	 */
	
	protected $descricao_tipo;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=500)
	 */
	
	protected $cabecalho;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=500)
	 */
	
	protected $rodape;	
	
	/**
	 * @var int|null
	 *
	 * @ORM\Column(type="integer")
	 */
	
	protected $tipo_dest;	
	
	public function __toString()
	{
		return $this->nome_tipo;
	}
	
	
	
}
