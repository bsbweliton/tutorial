<?php

/**
 * namespace de localizacao do nosso formulario
 */
namespace Documento\Form;

// import Form
use Zend\Form\Form;
// import Element
use Zend\Form\Element;

class DocumentoForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct($name);
        
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
    }

}
