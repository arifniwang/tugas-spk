<?php
/**
 * Created by PhpStorm.
 * User: niwang
 * Date: 6/2/20
 * Time: 2:34 PM
 */

class NiwangHelper
{
	/**
	 * @param $name
	 * @param $callback
	 */
	public function uploadImage($name)
	{
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES[$name]["name"]);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		
		$check = getimagesize($_FILES[$name]["tmp_name"]);
		if ($check === false) { // invalid  file image
			return null;
		} elseif (file_exists($target_file)) { // exist file not uploaded
			return $target_file;
		} elseif ($_FILES[$name]["size"] > 500000) { //validate size
			return null;
		} elseif (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) { //validate extension
			return null;
		} elseif (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) { //uploading file
			return $target_file;
		} else {
			return null;
		}
	}
	
	/**
	 * @param $name
	 * @return null|string
	 */
	public function uploadFile($name)
	{
		$target_dir = "uploads/file/";
		$target_file = $target_dir . basename($_FILES[$name]["name"]);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		
		$check = filesize($_FILES[$name]["tmp_name"]);
		if ($check === false) { // invalid  file image
			return null;
		} elseif (file_exists($target_file)) { // exist file not uploaded
			return $target_file;
		} elseif ($_FILES[$name]["size"] > 500000) { //validate size
			return null;
		} elseif (!in_array($imageFileType, ['pdf'])) { //validate extension
			return null;
		} elseif (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) { //uploading file
			return $target_file;
		} else {
			return null;
		}
	}
	
	/**
	 * @param $parameter
	 */
	public function dd($parameter)
	{
		$json = json_encode($parameter);
		
		if ($json !== null) {
			echo $json;
		} else {
			var_dump($parameter);
		}
		exit();
	}
}