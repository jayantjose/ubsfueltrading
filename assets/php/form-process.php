<?php
$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// PHONE
if (empty($_POST["phone"])) {
    $errorMSG .= "Phone is required ";
} else {
    $phone = $_POST["phone"];
}


// MSG SUBJECT
if (empty($_POST["msg_subject"])) {
    $errorMSG .= "Subject is required ";
} else {
    $msg_subject = $_POST["msg_subject"];
}


// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}


$EmailTo = "ubsbunkering@gmail.com";
$Subject = "New Message from Website - UBS Fuel Trading L.L.C.";

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Phone: ";
$Body .= $phone;
$Body .= "\n";
$Body .= "Subject: ";
$Body .= $msg_subject;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

// send email
$headers = 'From: UBS Fuel Trading L.L.C.  <queries@ubsfueltrading.com>' . "\r\n" .
	'Reply-To: UBS Fuel Trading L.L.C.  <queries@ubsfueltrading.com>' . "\r\n" .
	'Bcc : jayant.jose@gmail.com'. "\r\n" .
	'X-Mailer: PHP/' . phpversion();

$success = mail($EmailTo, $Subject, $Body, $headers);

// redirect to success page
if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}


// Save to Contact XML File
$contactFile = "xml/contact.xml";

$xml = new DOMDocument();

$nodeID=1;
if(file_exists($contactFile)) {
	$xml->load($contactFile);
	$nodes = $xml->getElementsByTagName('Name') ;
	$nodeID = $nodes->length;
	$nodeID++;
	$root_node = $xml->documentElement;
}
else {
	$root_node = $xml->createElement("contacts");
}

$xml_contact = $xml->createElement("contact");
$xml_id = $xml->createElement("id",$nodeID);
$xml_name = $xml->createElement("Name",$name);
$xml_email = $xml->createElement("Email",$email);
$xml_sub = $xml->createElement("Subject",$msg_subject);
$xml_message = $xml->createElement("Message",$message);
$xml_date = $xml->createElement("Date",date("d-m-Y H:i:s"));

$xml_contact->appendChild( $xml_id );
$xml_contact->appendChild( $xml_name );
$xml_contact->appendChild( $xml_email );
$xml_contact->appendChild( $xml_sub );
$xml_contact->appendChild( $xml_message );
$xml_contact->appendChild( $xml_date );

$root_node->appendChild( $xml_contact );

$xml->appendChild( $root_node );

$xml->save($contactFile);


?>