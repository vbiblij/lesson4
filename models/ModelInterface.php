<?php
namespace Models;

interface ModelInterface{
	public static function tableName();
	public static function find($condition);
	public static function findOne($condition);
	
	public static function insert($array);
}