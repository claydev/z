<?php
define('API_KEY', '272210515:AAGkQp54p6aQzbI3qNNJ6abC0wXhMouaGIo');
$admin = "90516804,172561830";
function mute($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));
$chat_id = $update->message->chat->id;
$text = $update->message->text;
$from = $update->message->from->id;
  if(preg_match('/^([Hh]ttp|[Hh]ttps)(.*)/',$text)){
    $short = file_get_contents('http://yeo.ir/api.php?url='.$text);
    roonx('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"🔗 Your Short LInk : ".$short."\n@TgHelper",
      'parse_mode'=>'HTML'
    ]);
  }
  if(preg_match('/^\/([sS]tart)/',$text)){
	  mute('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"Hi 😉👋\nIm Bot Short LInker 😃\nPlease Send Your Link 😎\n\n@Mega_Force_Bot",
      'parse_mode'=>'HTML'
    ]);
  }
  if(preg_match('/^\/([Ss]tats)/',$text) and $from == $admin){
    $user = file_get_contents('user.txt');
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
    mute('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"👤 members : $member_count",
      'parse_mode'=>'HTML'
    ]);
}
$user = file_get_contents('user.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('user.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('user.txt',$add_user);
    }
	?>
