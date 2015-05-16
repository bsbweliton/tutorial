<?php
namespace Documento\Controller;

use LosBase\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Form;
use Zend\Form\Annotation\AnnotationBuilder;
use LosBase\Entity\EntityManagerAwareTrait;
use Documento\Form\DocumentoForm;



class CrudController extends AbstractCrudController
{
	public function geraroficioAction()
	{
		$this->insertCssDoc($this);
		$this->insertJScriptGeraDoc($this);			    
	    $form = new DocumentoForm($this->getEntityManager());	   
		
		$classe = $this->getEntityClass();
		$entity = new $classe();
		$form->bind($entity);				
		
		$redirectUrl = $this->url()->fromRoute($this->getActionRoute(), [], true);
		$prg = $this->fileprg($form, $redirectUrl, true);
				
		return [
				'entityForm' => $form,
				'entity' => $entity,
		];		
		
		$savedEntity = $this->getEntityService()->save($form, $entity);
		
		if (! $savedEntity) {
			return [
					'entityForm' => $form,
					'entity' => $entity,
			];
		}		
		
		$this->flashMessenger()->addSuccessMessage($this->getServiceLocator()
				->get('translator')
				->translate($this->successAddMessage));
		
		return $this->redirect()->toRoute($this->getActionRoute('list'), [], true);		
		
		/*
		//return new ViewModel(array('teste' => 'asdasd'));
		$view = new ViewModel();
		
		$view->setVariable("teste", "Weliton Fonseca Amaral");
		//$view->setTemplate('Documento/Crud/geraroficio.phtml'); // path to phtml file under view folder
		return $view;	*/	
	}
	

	
	private function insertCssDoc(AbstractCrudController $controller)
	{
		$headLink = $controller->getServiceLocator()->get('viewhelpermanager')
		->get('losheadlink');
		$basePath = $controller->getRequest()->getBasePath();
	
		$headLink->appendStylesheet($basePath.'/sisgeof/css/general.css')
		->appendStylesheet($basePath.'/sisgeof/css/token-input.css')
		->appendStylesheet($basePath.'/sisgeof/css/memorando.css')
		->appendStylesheet($basePath.'/sisgeof/css/simplemodal.css')
		->appendStylesheet($basePath.'/sisgeof/css/nyroModal.css')
		->appendStylesheet($basePath.'/sisgeof/css/validationEngine.jquery.css');
	}	
	
	private function insertJScriptGeraDoc(AbstractCrudController $controller)
	{
		$headScript = $controller->getServiceLocator()->get('viewhelpermanager')
		->get('losheadscript');
		$basePath = $controller->getRequest()->getBasePath();
		
		$headScript
		->appendFile($basePath.'/sisgeof/js/jquery.mask.js')
		->appendFile($basePath.'/sisgeof/js/jquery.tools.min.js')
		->appendFile($basePath.'/sisgeof/js/tinymce/tinymce.min.js')
		->appendFile($basePath.'/sisgeof/js/jquery.tokeninput-sisgeof.js')
		->appendFile($basePath.'/sisgeof/js/jquery.tokeninput.receptor.js')
		->appendFile($basePath.'/sisgeof/js/jquery.tokeninput.autoridadereceptor.js')
		->appendFile($basePath.'/sisgeof/js/jquery.blockUI.js')
		->appendFile($basePath.'/sisgeof/js/jquery.autosave.js')
		->appendFile($basePath.'/sisgeof/js/jquery.save.js')
		
		->appendFile($basePath.'/sisgeof/js/phpjs/strings/join.js')
		->appendFile($basePath.'/sisgeof/js/phpjs/array/array_map.js')
		->appendFile($basePath.'/sisgeof/js/phpjs/funchand/create_function.js')
		->appendFile($basePath.'/sisgeof/js/phpjs/array/in_array.js')
		->appendFile($basePath.'/sisgeof/js/phpjs/strings/ucfirst.js')
		->appendFile($basePath.'/sisgeof/js/phpjs/strings/implode.js')
		->appendFile($basePath.'/sisgeof/js/phpjs/strings/explode.js')
		->appendFile($basePath.'/sisgeof/js/phpjs/strings/strtolower.js')
		
		->appendFile($basePath.'/sisgeof/js/sisgeof.js')
		
		->appendFile($basePath.'/sisgeof/js/jquery.nyroModal.custom.js')
		->appendFile($basePath.'/sisgeof/js/jquery.nyroModal-ie6.js')
		->appendFile($basePath.'/sisgeof/js/jquery.validationEngine.js')
		->appendFile($basePath.'/sisgeof/js/languages/jquery.validationEngine-pt.js')
		->appendFile($basePath.'/sisgeof/js/popup.js')
		
		->appendFile($basePath.'/sisgeof/js/tinymce.js');
	}
}
