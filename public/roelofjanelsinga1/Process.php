<?php

session_start();
$url = '/source/';

include 'source/classes/Functions.php';

if (isset($_POST['login'])) {
    if (isset($_POST['keep'])) {
        if (setCookieLogin($_POST['email'], $_POST['password'])) {
            header('Location: ' . $url . 'work');
        } else {
            header('Location: ' . $url . 'login/error');
        }
    } elseif (login($_POST['email'], $_POST['password'])) {
        header('Location: ' . $url . 'work');
    } else {
        header('Location: ' . $url . 'login/error');
    }
} elseif (isset($_GET['signout'])) {
    if (logout()) {
        header('Location: ' . $url);
    } else {
        header('Location: ' . $url . 'work/error/');
    }
}

//----------------WORK------------------------------------
elseif (isset($_POST['request'])) {
    switch ($_POST['request']) {
        case 'removeWork':
            removeWork($_POST['request_id']);
            break;
        default:
            echo 'default';
    }
} elseif (isset($_POST['add_work'])) {
    if (addWork($_POST['title'], $_FILES['image'], $_POST['summary'], $_POST['url'])) {
        header('Location: ' . $url . 'work');
    }
}

//----------------Content---------------------------------
elseif (isset($_POST['saveContent'])) {
    if (saveContent(
                    $_POST['home_title'], $_POST['home_text'], $_POST['work_title'], $_POST['work_text'], $_POST['services_title'], $_POST['services_text'], $_POST['about_title'], $_POST['about_text'], $_POST['contact_title'], $_POST['contact_text'], $_POST['footer_title'], $_POST['footer_text']
            )) {
        header('Location: ' . $url . 'content');
    }
}

//------------------CONTACT---------------------------------
elseif (isset($_POST['contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = nl2br($_POST['message']);

    // multiple recipients
    $to = 'roelofjanelsinga@gmail.com';

    // subject
    $subject = 'Form submission';

    // message
    $message = '
	<html>
	<head>
	  <title>Form Submission from: ' . $name . '</title>
	</head>
	<body>
		<p>' .
            $message
            . '</p>
		<p>' . $name . '\'s email: ' . $email . '</p>
	</body>
	</html>
	';

    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'From: Roelofjanelsinga.nl <info@roelofjanelsinga.nl>' . "\r\n";

    // Mail it
    mail($to, $subject, $message, $headers);
    echo $name . ' ' . $email . ' ' . str_replace("/n", "<br />", $_POST['message']);
    header('Location: ' . $url);
}


//----------------If everything fails---------------------
else {
    header('Location: ' . $url);
}
