<?php

/**
 * namespace de localizacao do nosso formulario
 */
namespace Documento\Form;

// import Form
use Zend\Form\Form;
// import Element
use Zend\Form\Element;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineORMModule\Stdlib\Hydrator;
use Doctrine\ORM\EntityManager;

class DocumentoForm extends Form
{

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct("documentoForm");                
        
        $builder = new AnnotationBuilder();
        
        $entity = new \Documento\Entity\Documento();
        
        $hydrator = new DoctrineHydrator($entityManager, $entity);
        
        $this->setHydrator($hydrator);
        
        $fieldset = $builder->createForm( $entity ) ;     

        $fieldset->setUseAsBaseFieldset(true);
        
        $this->add( $fieldset );        
        
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'docrecebido',
				'attributes' => array(
						'id'            => 'docrecebido',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'corpodocvis',
				'attributes' => array(
						'id'            => 'corpodocvis',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'cabecalhohidden',
				'attributes' => array(
						'id'            => 'cabecalhohidden',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'corposemformat',
				'attributes' => array(
						'id'            => 'corposemformat',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'tipodestinogrupo',
				'attributes' => array(
						'id'            => 'tipodestinogrupo',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'iddoc',
				'attributes' => array(
						'id'            => 'iddoc',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'idreceptor',
				'attributes' => array(
						'id'            => 'idreceptor',
				),
		));
		
		// elemento do tipo hidden
		$this->add(array(
				'type' => 'Hidden', # ou 'type' => 'ZendFormElementHidden'
				'name' => 'idautoridadereceptor',
				'attributes' => array(
						'id'            => 'idautoridadereceptor',
				),
		));		
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Csrf',
				'name' => 'csrf'
		));
		
		$this->add(array(
				'name' => 'submit',
				'attributes' => array(
						'type' => 'submit',
						'value' => 'Save'
				)
		));		
    }

}
