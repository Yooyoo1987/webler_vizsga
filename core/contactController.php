<?php
    ini_set('SMTP', 'smtpout.secureserver.net');
    ini_set('smtp_port', 25);
    
function contactController()
{
    $emptyField = array_key_exists("emptyField", $_COOKIE);
    setcookie("emptyField", "", time() - 1);
    $emailFormat = array_key_exists("emailFormat", $_COOKIE);
    setcookie("emailFormat", "", time() - 1);
    $success = array_key_exists("success", $_COOKIE);
    setcookie("success", "", time() - 1);

    return [
        "contact",
        [
            "title" => "Contact",
            "emptyField" => $emptyField,
            "emailFormat" => $emailFormat,
            "success" => $success
        ]
    ];
}

function contactFormController()
{

    $lastName = $_POST['userLastName'];
    $firstName = $_POST['userFirstName'];
    $visitorEmail = $_POST['userEmail'];
    $visitorMessage = $_POST['userMessage'];

    if (empty($lastName) || empty($firstName) || empty($visitorEmail) || empty($visitorMessage)) {
        setcookie("emptyField", 1, time() + 1);
    } else {

        if (!filter_var($visitorEmail, FILTER_VALIDATE_EMAIL)) {
            $emailFormat = setcookie("emailFormat", 1, time() + 1);
        }

        if (!$emailFormat) {
            if (isset($_POST['userMessageBtn'])) {
                $email_from = $visitorEmail;
                $email_subject = "Új üzenet Érkezett!";
                $email_body = $lastName . " " . $firstName . ": új üzenetet küldött!" . "\nÜzenete:\n" . $visitorMessage;
                $header = "From: $email_from \r\n";

                $to = "yooyoo@yooyoo.nhely.hu";

                mail($to, $email_subject, $email_body, $header);
                setcookie("success", 1, time() + 1);
            }
        }
    }
    $view = "redirect:/contact";
    return [
        $view,
        [
            "title" => "Contact"
        ]
    ];
}
