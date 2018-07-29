<?php

class SocialController extends BaseController {
	// atgriezam lietotaja samionitore info
	public function get_getdata($imei_code, $sha1)
	{
		$status = Social::GetData($imei_code, $sha1);

		if (is_array($status))
		{
			return Response::json($status);
		}

		return Response::json(array(
			array(
				"error" => "Something happened!",
				"status" => $status
			)
		));			
	}

	// atlasiit visus lietotaja atslegas vaardus
	public function get_getuser($imei_code, $sha1) 
	{
		$status = Social::GetUser($imei_code, $sha1);

		if (is_array($status))
		{
			return Response::json(array(
				array(
					"keys" => $status
				)
			));				
		}

		return Response::json(array(
			array(
				"error" => "Something happened!",
				"status" => $status
			)
		));	
	}

	// atsleegas vaarda dzeshana
	public function post_remav($imei_code, $sha1) 
	{
		$status = Social::RemAV($imei_code, $sha1);

		if ($status == 1)
		{
			return Response::json(array(
				array(
					"message" => "ok"
				)
			));
		}

		return Response::json(array(
			array(
				"error" => "Something happened!",
				"status" => $status
			)
		));		
	}

	// atsleegas vaarda pievienoshana
	public function post_addav($imei_code, $sha1)
	{
		$status = Social::AddAV($imei_code, $sha1);

		if ($status == 1) 
		{
			return Response::json(array(
				array(
					"message" => "ok"
				)
			));
		}

		return Response::json(array(
			array(
				"error" => "Something happened!",
				"status" => $status
			)
		));		
	}

	// jusera pievienoshana
	public function get_add($imei_code, $sha1) 
	{
		$status = Social::Add($imei_code, $sha1);

		if ($status == 1) 
		{
			return Response::json(array(
				array(
					"message" => "ok"
				)
			));
		}

		return Response::json(array(
			array(
				"error" => "Something happened!",
				"status" => $status
			)
		));
	}
}
