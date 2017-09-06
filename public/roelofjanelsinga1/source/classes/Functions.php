<?php
include 'source/classes/Database.php';

function getContent($content)   {
    $db = new Database();
    $query = $db->getConnection()->query("SELECT * FROM `content` LEFT JOIN `positions` ON `content`.`position` = `positions`.`id` WHERE `positions`.`name`='".$content."'");
    $fetch = $query->fetch(PDO::FETCH_ASSOC);
    return $fetch;
}

function getItems($table) {
    $db = new Database();
    $query = $db->getConnection()->query("SELECT * FROM ".$table." ORDER BY `id` DESC");
    $array = [];
    $i = 0;
    while($fetch = $query->fetch(PDO::FETCH_ASSOC)) {
        $array[$i] = $fetch;
        $i++;
    }
    return $array;
}

//------------------------------------ACCESSING SYSTEM-----------------------------------------
function login($email, $pass) {
    $db = new Database();
    $s = $db->getConnection()->query("SELECT * FROM `user` WHERE `email`='" . $email . "';")->fetch(PDO::FETCH_ASSOC);
    if (empty($s['email'])) {
        return false;
    } else {
        if (password_needs_rehash($s['password'], PASSWORD_BCRYPT) && sha1($pass) === $s['password']) {
            $password = password_hash($pass, PASSWORD_BCRYPT);
            $update = $db->getConnection()->prepare("UPDATE user SET password=? WHERE id=?")->execute(array($password, $s['id']));

            $_SESSION['main_id'] = $s['id'];
            $_SESSION['main_user'] = $s;
            return true;
        } else {
            if (password_verify($pass, $s['password'])) {
                $_SESSION['main_id'] = $s['id'];
                $_SESSION['main_user'] = $s;
                return true;
            } else {
                return false;
            }
        }
    }
}

function setCookieLogin($email, $password)    {
    if(login($email, $password))    {
        setcookie("main_id", $_SESSION['main_id'], strtotime( '+30 days' ));
        return true;
    } else {
        return false;
    }
}

function validateVisit() {
    if(isset($_COOKIE['main_id']))   {
        $db = new Database();
        $query = $db->getConnection()->query("SELECT * FROM `user` WHERE id=".$_COOKIE['main_id']);
        $q = $query->fetch(PDO::FETCH_ASSOC);
        $_SESSION['main_user'] = $q;
        $_SESSION['main_id'] = $q['id'];
    }
}

function logout() {
    setcookie("main_id", $_SESSION['main_id'], 1);
    unset($_SESSION['main_id']);
    session_destroy();
    return true;
}

//------------------------------------WORK-----------------------------------------
function removeWork($id)   {
    $db = new Database();
    $file = $db->getConnection()->query("SELECT * FROM `work` WHERE `id`=".$id)->fetch(PDO::FETCH_ASSOC);
    if(unlink($file['image']))  {
        $query = $db->getConnection()->prepare("DELETE FROM `work` WHERE `id`=?")->execute(array($id));
    }
    return true;
}

function addWork($title, $image, $summary, $url)  {
    $var = time();
    if (move_uploaded_file($image['tmp_name'], 'uploads/' . $var .$image['name'])) {
        $filename = 'uploads/'.$var.$image['name'];
    }
    $db = new Database();
    $query = $db->getConnection()->prepare("INSERT INTO `work` VALUES(NULL, ?, ?, ?, ?, ?)")->execute(array($title, $filename, $summary, $url, date("Y-m-d")));
    return true;
}

//-----------------------------------CONTENT---------------------------------------
function saveContent($ht, $htxt, $wt, $wtxt, $st, $stxt, $at, $atxt, $ct, $ctxt, $ft, $ftxt)  {
    $db = new Database();
    $db->getConnection()->prepare("UPDATE `content` SET `title`=?, `text`=? WHERE `id`=9")->execute([$ht, $htxt]) or die(false);
    $db->getConnection()->prepare("UPDATE `content` SET `title`=?, `text`=? WHERE `id`=10")->execute([$wt, $wtxt]) or die(false);
    $db->getConnection()->prepare("UPDATE `content` SET `title`=?, `text`=? WHERE `id`=14")->execute([$st, $stxt]) or die(false);
    $db->getConnection()->prepare("UPDATE `content` SET `title`=?, `text`=? WHERE `id`=11")->execute([$at, $atxt]) or die(false);
    $db->getConnection()->prepare("UPDATE `content` SET `title`=?, `text`=? WHERE `id`=12")->execute([$ct, $ctxt]) or die(false);
    $db->getConnection()->prepare("UPDATE `content` SET `title`=?, `text`=? WHERE `id`=13")->execute([$ft, $ftxt]) or die(false);
    return true;
}