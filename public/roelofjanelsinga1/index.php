<?php
//Change url variable in index.php, .htaccess, Process.php, roelof.js
session_start();
require_once 'source/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('source/views');
$twig = new Twig_Environment($loader);

//autoload all classes in classes folder
include 'source/classes/Functions.php';

validateVisit();

/* GLOBAL VARIABLES */
$twig->addGlobal('sitename', 'Roelof Jan Elsinga');
$twig->addGlobal('keywords', 'roelof, jan, elsinga, web, design, development, freelancer, work, job, website, websites');
$twig->addGlobal('description', 'This is the portfolio website of Roelof Jan Elsinga. Here you will find all his work.');
$twig->addGlobal('author', 'Roelof Jan Elsinga');
$twig->addGlobal('url', '/source/');
/* END GLOBAL VARIABLES */   

//RENDER THE VIEWS
if (isset($_SESSION['main_id'])) {
    $twig->addGlobal('user', $_SESSION['main_user']);
    
    if(isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'work':
                echo $twig->render('work.twig', array(
                    'pagetitle' => 'work',
                    'work' => getItems('work'),
                ));
                break;
            case 'content':
                echo $twig->render('content.twig', array(
                    'pagetitle' => 'content',
                    'home' => getContent('home'),
                    'about' => getContent('about'),
                    'work' => getContent('work'),
                    'work_s' => getItems('work'),
                    'services' => getContent('services'),
                    'services_s' => getItems('services'),
                    'contact' => getContent('contact'),
                    'footer' => getContent('footer'),
                ));
                break;
            case 'add':
                switch($_GET['id']) {
                    case 'work':
                        echo $twig->render('add_work.twig', [
                            'pagetitle' => 'Add Work',
                        ]);
                        break;
                    default:
                        echo $twig->render('add_work.twig', [
                            'pagetitle' => 'Add Work',
                        ]);
                }
                break;
            default:
                echo $twig->render('work.twig', array(
                    'pagetitle' => 'work',
                    'work' => getItems('work'),
                ));
        }
    } else {
        echo $twig->render('index.twig', array(
            'pagetitle' => 'home',
            'home' => getContent('home'),
            'about' => getContent('about'),
            'work' => getContent('work'),
            'work_s' => getItems('work'),
            'services' => getContent('services'),
            'services_s' => getItems('services'),
            'contact' => getContent('contact'),
            'footer' => getContent('footer'),
        ));
    }
} else {
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'login':
                echo $twig->render('login.twig', array(
                    'pagetitle' => 'Log In',
                ));
                break;
			case 'action':
				login($_POST['email'], $_POST['password']);
                echo $twig->render('index.twig', array(
                    'pagetitle' => 'home',
                    'home' => getContent('home'),
                    'about' => getContent('about'),
                    'work' => getContent('work'),
                    'work_s' => getItems('work'),
                    'services' => getContent('services'),
                    'services_s' => getItems('services'),
                    'contact' => getContent('contact'),
                    'footer' => getContent('footer'),
                ));
                break;
            default:
                echo $twig->render('index.twig', array(
                    'pagetitle' => 'home',
                    'home' => getContent('home'),
                    'about' => getContent('about'),
                    'work' => getContent('work'),
                    'work_s' => getItems('work'),
                    'services' => getContent('services'),
                    'services_s' => getItems('services'),
                    'contact' => getContent('contact'),
                    'footer' => getContent('footer'),
                ));
        }
    } else {
        echo $twig->render('index.twig', array(
            'pagetitle' => 'home',
            'home' => getContent('home'),
            'about' => getContent('about'),
            'work' => getContent('work'),
            'work_s' => getItems('work'),
            'services' => getContent('services'),
            'services_s' => getItems('services'),
            'contact' => getContent('contact'),
            'footer' => getContent('footer'),
        ));
    }
}