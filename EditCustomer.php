<?php
session_start();
require_once("Includes/db.php");

if ($_SERVER['REQUEST_METHOD']== "POST") 
{
	
	$customerID = filter_input(INPUT_POST,'customerID',FILTER_SANITIZE_SPECIAL_CHARS);
    $back=filter_input(INPUT_POST,'back');
	
	//customers table (edit table members)
    $lname = filter_input(INPUT_POST,'lname');$fname = filter_input(INPUT_POST,'fname');
    $mi = filter_input(INPUT_POST,'mi');$name = filter_input(INPUT_POST,'name');$street = filter_input(INPUT_POST,'street');
    $city = filter_input(INPUT_POST,'city');$province = filter_input(INPUT_POST,'province');
    $country = filter_input(INPUT_POST,'country');$postal_code = filter_input(INPUT_POST,'postal_code');
    $phone = filter_input(INPUT_POST,'phone');$email = filter_input(INPUT_POST,'email');        
    $ship_name = filter_input(INPUT_POST,'ship_name');$ship_street = filter_input(INPUT_POST,'ship_street');
    $ship_city = filter_input(INPUT_POST,'ship_city');$ship_province = filter_input(INPUT_POST,'ship_province');
    $ship_country = filter_input(INPUT_POST,'ship_country');$ship_postal_code = filter_input(INPUT_POST,'ship_postal_code');
    $ship_phone = filter_input(INPUT_POST,'ship_phone');$ship_email = filter_input(INPUT_POST,'ship_email');

	    /** Checks whether the $_POST array contains an element with the "back" key */
    if (array_key_exists($back)) {
        /** The Back to the List key was pressed.
         * Code redirects the user to the index.php */
        header('Location: ../customer/findCustomer.php');
        exit;
    }
        /** The "item" key in the $_POST array is NOT empty, so a item is entered.
     * Adds the street,city,province,etc  to the database via IcsDB.insert_customer
     */ 
      else if ($customerID == ""){
        CustDB::getInstance()->insert_customer($customerID,$lname,$fname,$mi,$name,$street,$city,$province,$country,$postal_code,$phone,$email,$ship_name,$ship_street,$ship_city,$ship_province,$ship_country,$ship_postal_code,$ship_phone,$ship_email);
        header('Location: customer.php');
        //exit;
    } else if (customerID != "") {
        CustDB::getInstance()->update_customer($customerID,$lname,$fname,$mi,$name,$street,$city,$province,$country,$postal_code,$phone,$email,$ship_name,$ship_street,$ship_city,$ship_province,$ship_country,$ship_postal_code,$ship_phone,$ship_email);
        header('Location: customer.php');
        exit;
    }
}