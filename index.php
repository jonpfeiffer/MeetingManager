<?php 

include($_SERVER['DOCUMENT_ROOT'] . '/MVC/app/core/initialize.php');


    $mainController = new MainController();
    // $ajaxController = new AjaxController();
    //Routing Controller

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
    }elseif($tail == "person"){
        
    }else{
        $mainController->defaultAction();
    }
   



    // switch ($tail) {
    //     case '\/meeting\/\d+':
    //         # code...
    //         break;
        
    //     default:
            
    //         break;
    // }(preg_match('/\/meeting\/\d+/'))
 ?>