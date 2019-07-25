<?php 

interface IApiUsable{ 
   	public function getOne($request, $response, $args); 
   	public function getAll($request, $response, $args); 
   	public function setOne($request, $response, $args);
   	public function deleteOne($request, $response, $args);
   	public function updateOne($request, $response, $args);

}