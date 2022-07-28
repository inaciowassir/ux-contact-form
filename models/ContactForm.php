<?php

/**
 * Created by PhpStorm.
 * User: Inacio Uassire Programmer
 * Date: 2022-07-27
 * Time: 4:39 PM
 */

namespace sprint\models;

use \sprint\database\Model;
use \sprint\srequest\SRequest;

class ContactForm extends Model
{
	private $table = "`contact_form`";
	
	public function removeDraft()
	{
		$this->delete($this->table)->where("name IS NULL AND email IS NULL")->run();
	}
	
	public function create()
	{
		$createdAt = date("Y-m-d H:i:s");		
		$this->insert($this->table)->values(
			array(
				"created_at" => $createdAt
			)
		);		
		
		$insertId = $this->insert_id();
		
		echo json_encode(array(
			"status" 	=> $insertId > 0 ? "success" : "failed",
			"id"		=> $insertId
		));
	}
	
	public function single($id)
	{
		return $this->find($this->table, $id);
	}
	
	public function datatable()
	{		
		$body = SRequest::body();
		
		$resultset = $this->select($this->table)
		->order("{$this->table}.created_at DESC")
		->limit($body["length"])
        ->offset($body["start"])
		->results();
		
		$this->query = "SELECT FOUND_ROWS() AS totalRecords";
        $totalRecords = $this->result("totalRecords");
		
		return array(
			"draw" 				=> isset($body['draw']) ? intval($body["draw"]) : 0,
			"recordsTotal" 		=> count($resultset),
			"recordsFiltered" 	=> $totalRecords,
			"data" 				=> $resultset,
		);
	}
	
	public function save($id)
	{
		try
		{
			$body 			= SRequest::body();
			$updated_at 	= date("Y-m-d H:i:s");
			$data 			= array_merge($body, ["updated_at"	=> $updated_at]);
			
			$this->update($this->table)->values($data)->where("id = {$id}");
			
			echo json_encode(array(
				"status" 	=> "success",
			));
		}catch(\PDOException $e)
		{
			echo json_encode(array(
				"status" 	=> "failed",
				"error"		=> $e->getMessage(),
			));
		}
	}
	
	public function remove($id)
	{
		try
		{
			$this->delete($this->table)->where("id = {$id}")->run();
			
			echo json_encode(array(
				"status" 	=> "success",
			));
		}catch(\PDOException $e)
		{
			echo json_encode(array(
				"status" 	=> "failed",
				"error"		=> $e->getMessage(),
			));
		}
	}
}
