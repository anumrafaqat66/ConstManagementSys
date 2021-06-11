<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('randomPassword')) {

    function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

}


if (!function_exists('slug_generator')) {
    function slug_generator($string, $table) {
        $CI = & get_instance();
        $string = strtolower(preg_replace('/[^a-zA-Z0-9- ]/', '', $string)); //Removes special characters
//        preg_replace("/ {2,}/", " ", $title); replace multiple spaces with 1 space
        $string = str_replace(" ", "-", trim(preg_replace("/ {2,}/", " ", $string)));
		$check_string = preg_replace('/-+/', '-', $string);
        $i = 1;
        $slug = "";
        while ($i > 0) {
            $CI->db->where("slug", $check_string);
            $data = $CI->db->count_all_results($table);
            if ($data > 0) {
                $check_string = $string . "-" . $i;
            } else {
                $slug = $check_string;
                break;
            }
            $i++;
        }
        return $slug;
    }
}

if (!function_exists('pr')) {

    function pr($content) {
        echo "<pre>";
        print_r($content);
        echo "<pre>";
        exit;
    }

}
/* End of file custom_helper.php */
/* Location: /front_app/helpers/custom_helper.php */