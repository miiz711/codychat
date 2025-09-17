<?php
$page_info = array(
	'page'=> 'home',
	'page_nohome'=> 1,
);
require("system/config.php");
require("system/points_system.php");

if($chat_install != 1){
	include('builder/encoded/installer.php');
	die();
}

// loading head tag element
include('control/head_load.php');

// loading page content
$data['user_roomid'] = getRoomId();
if($data['user_roomid'] > 0){
    // عرض الإعلانات في أعلى الشات
    echo '<div class="ad-container">
            <div class="scrolling-ad">'.getActiveAds().'</div>
          </div>';
    
    // عرض صندوق النقاط في الجانب
    echo '<div class="points-box">
            <div class="points-display">نقاطك: '.getUserPoints(mySelf()).'</div>
            <div class="weekly-top">
                <h4>المتصدرين</h4>
                '.getWeeklyTopUsersList().'
            </div>
          </div>';
    
    // عرض واجهة الشات
    include('control/chat.php');
}
else {
    include('control/lobby.php');
}

// close page body
include('control/body_end.php');

// وظيفة مساعدة لعرض قائمة المتصدرين
function getWeeklyTopUsersList() {
    $users = getWeeklyTopUsers();
    $html = '<ul class="top-users">';
    while($user = $users->fetch_assoc()) {
        $html .= '<li>'.$user['username'].' - '.$user['points'].' نقطة</li>';
    }
    $html .= '</ul>';
    return $html;
}
?>