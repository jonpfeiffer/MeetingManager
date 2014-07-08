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
        if ($query == 'old'){
            $mainController->oldMeetingAction(1);
        }elseif (MeetingManager::hasEndTime($query)){
            $mainController->detailMeetingAction($query);
        }else{
            $mainController->liveMeetingAction($query);
        }
    }else{
        $mainController->defaultAction();
    }
}elseif($tail == "start"){
    $mainController->startMeetingAction();
}elseif($tail == "end"){
    $mainController->endMeetingAction();
}elseif($tail == "task"){
    $mainController->addTaskAction($_POST);
}elseif($tail == "time"){
    $mainController->addTimeAction($_POST);
}else{
    $mainController->defaultAction();
}
   
 ?>