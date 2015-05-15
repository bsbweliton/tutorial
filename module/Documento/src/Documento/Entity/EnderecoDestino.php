<?php
namespace Documento\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use LosBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="endereco_destino")
 */
class EnderecoDestino extends AbstractEntity
{
	/**
	 * @var int|null
	 *
	 * @ORM\Id
	 * @ORM\Column(name="id_endereco_destino", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @Form\Exclude()
	 */

	protected $id;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=300)
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"logradouro"})
	 * @Form\Options({"label":"Logradouro"})
	 */
	
	protected $logradouro;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=11)
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"cep"})
	 * @Form\Options({"label":"Cep"})
	 */
	
	protected $cep;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=200)
	 * @Form\Attributes({"type":"text", "class":"form-control", "id":"cidade"})
	 * @Form\Options({"label":"Cidade"})
	 */
	
	protected $cidade;	
	
	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="string", length=2)
	 * @Form\Type("Zend\Form\Element\Select")
	 * @Form\Attributes({"class":"form-control", "id":"estado"})
	 * @Form\Options({"label":"Estado", "value_options":{
	 * 		"ac":"Acre",
	 * 		"al":"Alagoas",
	 * 		"ap":"Amapá",
	 * 		"am":"Amazonas",
	 * 		"ba":"Bahia",
	 * 		"ce":"Ceará",
	 * 		"df":"Distrito Federal",
	 * 		"es":"Espírito Santo",
	 * 		"go":"Goiás",
	 * 		"ma":"Maranhão",	  			  			  			  			  			  			  		
	 * 		"ms":"Mato Grosso do Sul",
	 * 		"mt":"Mato Grosso",
	 * 		"mg":"Minas Gerais",
	 * 		"pa":"Pará",
	 * 		"pb":"Paraíba",
	 * 		"pr":"Paraná",
	 * 		"pe":"Pernambuco",	  			  			  			  			  			  			  		
	 * 		"pi":"Piauí",
	 * 		"rj":"Rio de Janeiro",
	 * 		"rn":"Rio Grande do Norte",
	 * 		"rs":"Rio Grande do Sul",	  			  			  			  		
	 * 		"ro":"Rondônia",
	 * 		"rr":"Roraima",
	 * 		"sc":"Santa Catarina",
	 * 		"sp":"São Paulo",
	 * 		"se":"Sergipe",
	 * 		"to":"Tocatins"	  			  			  			  			  		
	 * 		}
	 * 	})
	 */
	
	protected $estado;	
}
