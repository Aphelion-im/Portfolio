<?php

// configure
$from = 'Contact formulier Amdegroot.nl <slaygen@gmail.com>';
$sendTo = 'Contact formulier Amdegroot.nl <slaygen@gmail.com>';
$subject = 'Nieuw bericht van het contact formulier';
$fields = array('name' => 'Naam', 'surname' => 'Achternaam', 'phone' => 'Telefoon', 'email' => 'Email', 'message' => 'Bericht'); // array variable name => Text to appear in the email
$okMessage = 'Contact formulier succesvol verzonden. Bedankt, ik neem zo spoedig mogelijk contact op.';
$errorMessage = 'Er is een fout opgetreden tijdens het versturen van het formulier. Probeer nogmaals op een later tijdstip.';

// let's do the sending

try
{
    $emailText = "Je hebt een nieuw bericht ontvangen van het contact formulier\n=============================\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}
