<?php 

include($_SERVER['DOCUMENT_ROOT'] . '/MVC/app/core/initialize.php');


$mainController = new MainController();
session_start();
//if(!LoggedIn){
//  header('Location: login.php');
//}else{}
// Get Routing info
$urlParts = parse_url($_SERVER['REQUEST_URI']);
$url = $urlParts["path"];
$pieces = explode('/', $url);
$tail = $pieces[count($pieces)-1];    
$isPost = ($_SERVER['REQUEST_METHOD'] == "POST");



// if($tail == "newmeeting"){
//     $mainController->newMeetingAction();
// }elseif($tail == "login"){
//     $mainController->loginAction();
// }else
if ($tail == "newmeeting" && $isPost) {
    // die(print_r($_POST));
    $mainController->createMeetingAction($_POST);
}elseif($tail == "newmeeting"){
    $mainController->newMeetingAction();
}elseif($tail == "person" && $isPost){
    $mainController->newMeetingAction($meeting);
}elseif($tail == "meeting"){
    if(array_key_exists("query", $urlParts)){
        $qPieces = explode('=', $urlParts["query"]);
        $query = $qPieces[1];
        $mainController->liveMeetingAction($query);
    }else{
        $mainController->defaultAction();
    }
}else{
    $mainController->defaultAction();
}
   
 ?>