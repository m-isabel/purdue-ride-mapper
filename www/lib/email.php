<?php

/**
 *
 * Send email using the local smtp server
 *
 * The following functions send emails to users for different purposes
 * (i.e registration, forgot password).
 *
 * @author   Timothy Thong <tthong@purdue.edu>
 * @version  1.0
 */ 

/**
 *
 * These global variables MUST NOT BE CHANGED. 
 * The $headers variable must be passed to
 * mail() for all outgoing mails
 *
 */
$orgEmail = "donotreply@collegecarpool.us";
$orgName  = "College Carpool";

$headers  = "MIME-Version: 1.0" . "\r\n" .
            "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
            "From: $orgName <$orgEmail>\r\n";

/**
 * 
 * Send a registration mail containing an activation link
 *
 * @param	string $rcpt   new user's email
 * @param	string $fname  user's first name           
 * @param	string $uid    user id
 * @param	string $token  generated token for activation
 *
 */
function sendRegMail($rcpt, $fname, $uid, $token)
{
        global $orgEmail,$orgName, $headers;

        $vlink = "http://collegecarpool.us/modules/register/verify.php?" .
                 "id=$uid&token=$token";

        $subject = "Welcome to College Carpool!";

        $msg = "<html><body>" .
                   "Dear $fname,<br><br>" .
                   "Thank you for joining Purdue Ride Mapper!<br><br>" .
                   "Please activate your account by &nbsp;" . 
                   "visiting the link below:<br><br>" .
                   "<a href=\"$vlink\">$vlink</a><br><br><br>" . 
                   "Purdue Ride Mapper Team" .
                   "</body></html>";

        mail($rcpt, $subject, $msg, $headers);
}

?>
