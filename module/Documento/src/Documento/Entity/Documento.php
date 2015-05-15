<?php
namespace Documento\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use LosBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="documento")
 * @Form\Name("formDocumento")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("LosBase\Form\AbstractForm")
 */
class Documento extends AbstractEntity
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
	 * @var int|null
	 *
	 * @ORM\OneToOne(targetEntity="Documento\Entity\TipoDocumento")
	 * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
	 * @ORM\OrderBy({"nome" = "ASC"})
	 * @Form\Options({"label":"Tipo do documento", "target_class":"Documento\Entity\TipoDocumento","find_method":{"name":"findBy","params":{"criteria":{}, "orderBy":{"nome_tipo":"ASC"}}},"display_empty_item":true,"empty_item_label":"---"})
	 * @Form\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Form\Required(true)
	 */	

	protected $idtipo_documento;	

	/**
	 * @var int|null
	 *
	 * @ORM\OneToOne(targetEntity="Documento\Entity\Lotacao", fetch="EAGER")
	 * @ORM\OrderBy({"sigla" = "ASC"})
	 * @Form\Attributes({"id":"idLotacao", "class":"form-control"})
	 * @Form\Options({"label":"Lotação de origem", "target_class":"Documento\Entity\Lotacao","find_method":{"name":"findBy","params":{"criteria":{}, "orderBy":{"sigla":"ASC"}}},"display_empty_item":true,"empty_item_label":"---"})
	 * @Form\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Form\Required(true)
	 */	

	
	protected $idLotacao;	
	
	/**
	 * @var int|null
	 *
	 * @ORM\OneToOne(targetEntity="Documento\Entity\Lotacao", fetch="EAGER")
	 * @ORM\OrderBy({"sigla" = "ASC"})
	 * @Form\Attributes({"id":"destino_idsetor", "class":"form-control"})
	 * @Form\Options({"label":"Lotação ID", "target_class":"Documento\Entity\Lotacao","find_method":{"name":"findBy","params":{"criteria":{}, "orderBy":{"sigla":"ASC"}}},"display_empty_item":true,"empty_item_label":"---"})
	 * @Form\Type("DoctrineModule\Form\Element\ObjectSelect")
	 * @Form\Required(false)
	 */
	
	protected $destino_idsetor;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=150)
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":150}})
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Destino Nome"}) 
	 */
	
	protected $destino_nome;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=150)
	 * @Form\Filter({"name":"StringTrim"})
	 * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":150}})
	 * @Form\Attributes({"type":"text"})
	 * @Form\Options({"label":"Interessados"})
	 */
	
	protected $interessados;	
	
	/**
	 * @var int|null
	 *
	 * @ORM\Column(type="integer")
	 * @Form\Exclude()
	 */
	
	protected $numeracao_documento;	
	
	/**
	 * @var int|null
	 *
	 * @ORM\Column(type="integer")
	 * @Form\Exclude()
	 */
	
	protected $autor;
	
	/**
	 * @var Date|null
	 *
	 * @ORM\Column(type="date")
	 * @Form\Exclude()
	 */
	
	protected $data_geracao;	
	
	/**
	 * @var String|null
	 *
	 * @ORM\Column(type="text")
	 * @Form\Attributes({"type":"textarea", "rows":"25", "id":"corpo_doc"})
	 * @Form\Options({"label":"Corpo do documento"})
	 * */
	
	protected $corpo_doc;

	/**
	 * @var int|null
	 *
	 * @ORM\Column(type="boolean")
	 * @Form\Exclude()
	 * */
	
	protected $ativo;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=100)
	 * @Form\Exclude()
	 */
	
	protected $path;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=50)
	 * @Form\Exclude()
	 */
	
	protected $filename;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=400)
	 * @Form\Filter({"name":"StringTrim"})
	 * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":400}})
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"assunto"})
	 * @Form\Options({"label":"Assunto"})
	 * @Form\Required(true)
	 */
	
	protected $assunto;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=80)
	 * @Form\Filter({"name":"StringTrim"})
	 * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":80}})
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"referencia"})
	 * @Form\Options({"label":"Referência"})
	 * @Form\Required(false)
	 */
	
	protected $referencia;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=80)
	 * @Form\Filter({"name":"StringTrim"})
	 * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":80}})
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"vocativoinput"})
	 * @Form\Options({"label":"Vocativo"})
	 * @Form\Required(false)
	 */
	
	protected $vocativo;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=80)
	 * @Form\Filter({"name":"StringTrim"})
	 * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":80}})
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"enderecamento", "readonly":"readonly"})
	 * @Form\Options({"label":"Endereçamento"})
	 * @Form\Required(false)
	 */
	
	protected $enderecamento;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=45)
	 * @Form\Filter({"name":"StringTrim"})
	 * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":45}})
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"fechoinput", "readonly":"readonly"})
	 * @Form\Required(false)
	 */
	
	protected $fecho;	
	
	/**
	 * @var int|null
	 *
	 * @ORM\Column(type="boolean")
	 * @Form\Exclude()
	 * */
	
	protected $rascunho;

	/**
	 * @var Date|null
	 *
	 * @ORM\Column(type="date")
	 * @Form\Exclude()
	 */
	
	protected $data_geracao_log;

	/**
	 * @var Time|null
	 *
	 * @ORM\Column(type="time")
	 * @Form\Exclude()
	 */
	
	protected $hora_geracao_log;	
	
	/**
	 * @var int|null
	 *
	 * @ORM\OneToOne(targetEntity="Documento\Entity\Receptor")
	 * @ORM\JoinColumn(nullable=true, onDelete="CASCADE", referencedColumnName="id_receptor")
	 * @ORM\OrderBy({"nome" = "ASC"})
	 * @Form\ComposedObject("Documento\Entity\Receptor")
	 * @Form\Attributes({"type":"hidden"})
	 */
	
	protected $receptor;	
	
	/**
	 * @var int|null
	 *
	 * @ORM\OneToOne(targetEntity="Documento\Entity\AutoridadeReceptor", fetch="EAGER")
	 * @ORM\JoinColumn(nullable=false, onDelete="CASCADE", referencedColumnName="id_autoridade_receptor")
	 * @ORM\OrderBy({"nome" = "ASC"})
	 * @Form\ComposedObject("Documento\Entity\AutoridadeReceptor")
	 * @Form\Attributes({"type":"hidden"})
	 */	
	
	protected $autoridadeReceptor;	
	
}
