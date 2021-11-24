<?php


if(!function_exists('countries')){

	function countries(){

		$countries = DB::table('countries')->get();

		return $countries;

	}

}