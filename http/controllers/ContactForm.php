<?php

/**
 * Created by PhpStorm.
 * User: Inacio Uassire Programmer
 * Date: 2022-07-27
 * Time: 4:39 PM
 */

namespace sprint\http\controllers;

use \sprint\http\core\Controller;
use \sprint\srequest\SRequest;

class ContactForm extends Controller
{
	private $data = [];
	private $contactForm;
	/**
	 *
	*/
	public function __construct()
	{
		$this->viewsPath    = "views/layouts/ContactForm";
		$this->contactForm  = new \sprint\models\ContactForm();	
	}

	public function index()
	{
		$this->contactForm->removeDraft();
		return $this->view("Index");
	}
	
	public function datatable()
	{		
		$this->viewsPath 		= "views/layouts/Components/ContactForm/";
		$response 				= $this->contactForm->datatable();		
		$this->data["response"] = $response["data"];
		$view 					= $this->cView("DataTable", $this->data);
		
		echo json_encode(
			array(
				"draw" 				=> $response["draw"],
				"recordsTotal" 		=> $response["recordsTotal"],
				"recordsFiltered" 	=> $response["recordsFiltered"],
				"data" 				=> json_decode($view),
			)
        );
	}
	
	public function create()
	{
		return $this->contactForm->create();
	}
	
	public function save($id)
	{
		if(SRequest::isGet())
		{
			$this->data["response"] = $this->contactForm->single($id);			
			$this->data["id"] 		= $id;
			
			return $this->view("Save", $this->data);
		}		
		return $this->contactForm->save($id);
	}
	
	public function details($id)
	{
		$this->data["response"] = $this->contactForm->single($id);			
		$this->data["id"] 		= $id;
			
		return $this->view("Details", $this->data);
	}
	
	public function remove($id)
	{		
		return $this->contactForm->remove($id);
	}
}
