<?php
$EmailFrom = "info@coderelax.com";
$EmailTo = "famoreira@gmail.com";
$Subject = "Enquiry from Coderelax";

$Name = Trim(stripslashes($_POST['Name'])); 
$Email = Trim(stripslashes($_POST['Email'])); 
$Message = Trim(stripslashes($_POST['Message'])); 
$Services = join (',',$_POST['s']);
$Budget = join (',', $_POST['b']);
/*
print $Name;
print $Email;
print $Message;
print $Services;
print $Budget;
*/

function checkEmail($e_mail) 
{ 
  // checks for proper syntax 
   if( (preg_match('/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/', $e_mail)) ||  
        (preg_match('/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?)$/',$e_mail)) ) {  
        $dom = explode('@', $e_mail); 
        if(checkdnsrr($dom[1].'.', 'MX') ) return true; 
        if(checkdnsrr($dom[1].'.', 'A') ) return true; 
        if(checkdnsrr($dom[1].'.', 'CNAME') ) return true; 
    } 
    return false;

}//End checkEmail

// validation
if(checkEmail($Email) != false) {
    $validationOK = true;
}
else{$validationOK = false;}

//print $validationOK;

if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=contacterror.html\">";
  exit;
}

// prepare email body text
$Body = "From: $Name\n Email: $Email\n Budget: $Budget\n Services: $Services\n Message: $Message";
/*$Body = "";
$Body = "Name: ";
$Body = $Name;
$Body = "\n";
$Body = "Email: ";
$Body = $Email;
$Body = "\n";
$Body = "Budget: ";
$Body = $Budget;
$Body = "\n";
$Body = "Services: ";
$Body = $Services;
$Body = "\n";
$Body = "Message: ";
$Body = $Message;
$Body = "\n";
*/


// send email 
$success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

// redirect to success page 

if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=contactthanks.html\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=contacterror.html\">";
}
?>
