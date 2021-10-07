<?php
function sendPushNotification($fcm_token, $title, $message) {  
     
    $url = "https://fcm.googleapis.com/fcm/send ";            
    $header = [
        'authorization: key=AAAAriAGwl8:APA91bGExbw5qr98W387pKDm62uJuMlp01xxGoNlyFj5nntrrJOZZTafTo_8PG7EH3-2JpSWLSl6zN9lJnLOoSzuz1lWQIr6fYrAvZEXIjA3XFhcmCtvyrrgefD4X3P4NTQEPF0NGXeG',
        'content-type: application/json'
    ];    
 
    $notification = [
        'title' =>$title,
        'body' => $message
    ];
    $extraNotificationData = ["message" => $notification];
 
    $fcmNotification = [
        'to'        => $fcm_token,
        'notification' => $notification,
        'data' => $extraNotificationData
    ];
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
 
    $result = curl_exec($ch);    
    curl_close($ch);
 
    return $result;
}