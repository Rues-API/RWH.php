<?php 

ob_start();

$API_KEY = '334365617:AAHnIM9Pq4FTaXXQejSQ3i1a7iWXI7WsoeI';
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
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
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$txt = $message->text;
$data = $update->callback_query->data;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;

if($txt == "/start"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*مرحبا بكم متابعينا 📝❤️*
*في بوت البحث الاضخم في منصة التليجرام 💬*

` مميزات البوت :- يمكنه البحث في مختلف 6 مواقع 📪 منها Google , Youtube 😃 `


`يمكنك ارسال اسم الشيء الذي تريد البحث عنه 📝`

*BY :* @NEAGHM",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>"RWH ⚡️", 'url'=>"t.me/RUESAPI"]
],
]])
]);
}

  if($txt != "/start"){
    bot('sendMessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    'text'=>"*تم العثور ع نتائج كثيرة 🔔*

`اختر الموقع الذي تريد البحث فيه☑️🔍 `

*By :* @NEAGHM",
'parse_mode'=>"Markdown",
    'reply_markup'=> json_encode([
    'inline_keyboard'=>[
    [
['text'=>"App store 🌐", 'url'=>"https://www.apple.com/us/search?q=$txt"],
],
[
['text'=>"Google 📈", 'url'=>"https://www.google.com.iq/search?q=$txt"],
],
[
['text'=>"Youtube 🎥", 'url'=>"https://m.youtube.com/results?q=$txt&sm=3"],
],
[
['text'=>"instagram 📯", 'url'=>"https://www.instagram.com/$txt"],
],

[
['text'=>"Telegram 📪", 'url'=>"https://www.telegram.me/$txt"],
],
[
['text'=>"Github 🐱", 'url'=>"https://github.com/search?utf8=✓&q=$txt"],
],
    ]
    ])
    ]);
    }
