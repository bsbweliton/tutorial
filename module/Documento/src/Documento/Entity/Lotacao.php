<?php
namespace Documento\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use LosBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="lotacao")
 */
class Lotacao extends AbstractEntity
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
	 * @ORM\Column(type="string", length=100)
	 */
	
	protected $noLotacao;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=45)
	 */
	
	protected $sigla;	
	
	/**
	 * @var int|null
	 *
	 * @ORM\Column(type="integer") 
	 */
	
	protected $idLotacaoPai;

	/**
	 * @var int|null
	 *
	 * @ORM\Column(type="integer") 
	 */
	
	protected $idGestor;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=2)
	 */
	
	protected $tratamentoGestor;	
	
	public function __toString()
	{
		return $this->sigla;
	}
	
	
	
}
