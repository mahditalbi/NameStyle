<?php

function Mrequest($api,$method,$data=array()){
    $ch= curl_init();
    curl_setopt($ch,CURLOPT_URL,"https://api.telegram.org/bot{$api}/{$method}");
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $respone = curl_exec ($ch);
    curl_close($ch);
    return $respone;
}

$i=0;
$last_updated_id= file_get_contents('lastid2.txt');
echo $last_updated_id;
function getUpdates()
{
    global $last_updated_id;
    global $i;
    while ($i <= 10) {

        $token = "Token_Bot";

        $updates = json_decode(Mrequest($token, "getUpdates", array("offset" => ($last_updated_id + 1))));
        if ($updates->ok == true && count($updates->result) > 0) {
            foreach ($updates->result as $update) {
                $last_updated_id = $update->update_id;
                file_put_contents('lastid2.txt', $last_updated_id);
                $chat_id = $update->message->chat->id;
                $message_id = $update->message->message_id;
                $name = $update->message->from->first_name;
                $lsname = $update->message->from->last_name;
                $username = $update->message->from->username;
                $type = $update->message->chat->type;
                $date = $update->message->date;
                $message_type = $update->message->entities[0]->type;
                $text = $update->message->text;
                $photo = $update->message->photo;
                $ph_id = $update->message->photo->PhotoSize->file_id;
                $video = $update->message->video;
                $audio = $update->message->audio;
                $chat_ids = $update->message->chat->type->supergroup;
                $edit_message = $update->message->edit_date;
                $iid = $update->CallbackQuery->id;
                $tried = $update->callback_query->data + 1;
                $message_id = $update->callback_query->message->message_id;

                Mrequest($token, "sendChatAction", [
                    "chat_id" => $chat_id,
                    "action" => "typing"]);

                $button = array(
                    'keyboard' =>
                        array(
                            // 〘〙 【】 ℱ  ❃❃ ,"ارسال پیام به سازنده"
                            array("()", "[]", "༽つ  ༽つ", "╰დ╮╭დ╯", "⋐⋑", "εз", "〘〙", "【】", "❃❃"),
                            [['text' => "تبلیغات شما در این جا", 'url' => "https://telegram.me/shitilestan"]],
                            [['text' => "راهنما", 'callback_data' =>'1']],
                            [['text' => "ما را به دیگران معرفی کنید", 'switch_inline_query']],
                        ),
                    'resize_keyboard' => true
                );
                $encodedMarkup = json_encode($button);


                if (callback_data == '1') {
                    Mrequest('answerCallbackQuery', [
                        'callback_query_id' => 'wherareyou',
                        'text' => "با سلام" . "
                        شما میتوانید با انتخاب یکی از دکمه های پایین نام زیبایی برای خود طراحی نموده و آن را بعنوان نام تلگرامی خود بگذارید تا دیگران هم دلشان بخواهد:)"
                        ,'alert_show' => true
                    ]);
                } elseif ($text == "/start") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "به ربات اسم فانتزی خوش آمدید یکی از حالت زیر را انتخاب نمایید تا ربات نم شما را در داخل آن قرار دهد"
                            ."
                        تقدیم به دوست عزیزم".$name,
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                } elseif ($text == "()") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "در حال ساخت نام شما ...",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    sleep(1);
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "(" . "_" . $name . "_" . ")",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    // end else if tag ()
                } elseif ($text == "[]") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "در حال ساخت نام شما ...",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    sleep(1);
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "[" . "_" . $name . "_" . "]",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                } elseif ($text == "༽つ  ༽つ") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "در حال ساخت نام شما ...",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    sleep(1);
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "༼ つ" . "_" . $name . "_" . "༽つ",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                } elseif ($text == "╰დ╮╭დ╯") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "در حال ساخت نام شما ...",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    sleep(1);
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "╰დ╮" . "_" . $name . "_" . "╭დ╯",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    //teg new εїз
                } elseif ($text == "⋐⋑") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "در حال ساخت نام شما ...",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    sleep(1);
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "⋐" . "_" . $name . "_" . "⋑",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                } elseif ($text == "εз") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "در حال ساخت نام شما ...",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    sleep(1);
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "ε" . "_" . $name . "_" . "з",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    // 〘〙 【】 ℱ  ❃❃
                } elseif ($text == "〘〙") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "در حال ساخت نام شما ...",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    sleep(1);
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "〘" . "_" . $name . "_" . "〙",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    // 〘〙 【】 ℱ  ❃❃
                } elseif ($text == "【】") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "در حال ساخت نام شما ...",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    sleep(1);
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "【" . "_" . $name . "_" . "】",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    // 〘〙 【】 ℱ  ❃❃
                } elseif ($text == "❃❃") {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "در حال ساخت نام شما ...",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    sleep(1);
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "❃" . "_" . $name . "_" . "❃",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                    // 〘〙 【】 ℱ  ❃❃
                }elseif ($message_type == $photo)
                {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "photo:".$ph_id."\n
                        @ch_jokdoni",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);

                }else {
                    Mrequest($token, "sendMessage", [
                        'chat_id' => $chat_id,
                        'text' => "دوست من گزینهی" . $text . "رو پیدا نکردم \n" . "لطفا از منوی زیر استفاده نمایید :)",
                        'parse_mode' => 'Markdown',
                        'reply_markup' => $encodedMarkup
                    ]);
                }
//
//                if ($text == "ارسال پیام به سازنده")
//                {
//                    Mrequest($token , "sendMessage" ,[
//                        'chat_id'=>$chat_id,
//                        'text'=> "پیام خود را ارسال نمایید :)",
//                        'parse_mode'=> 'Markdown',
//                        'reply_markup'=>$encodedMarkup
//                    ]);
//                    if ($text > "ارسال پیام به سازنده") {
//                        Mrequest($token, "forwardMessage", [
//                            'chat_id' => '106712898',
//                            'from_chat_id' => $chat_id,
//                            'message_id' => $message_id
//                        ]);
//                    }
            }

            Mrequest('answerInlineQuery', [
                'inline_query_id' => $update->inline_query->id,
                'results' => json_encode([]),
                'switch_pm_text' => 'ساختن جدید',
                'switch_pm_parameter' => 'new'
            ]);

            $DB = "دوست داری اسم خودت رو خیلی قشنگ تر داشته باشی؟؟
                من یه ربات رو میشناسم که میتونه این کار رو بکنه میخوای تو هم بیای توش عضو باشی اسم دلخواهت رو بسازی؟؟
                پس همین حالا روی دکمه شیشه ای پایین بزن تا عضو ربات بشی و برای خودت اسم عجیب و غریب بسازیD:
               ";
            Mrequest('answerInlineQuery', [
                'inline_query_id' => $update->inline_query->id,
                'cache_time' => 1,
                'results' => json_encode([[
                    'type' => 'article',
                    'id' => base64_encode(1),
                    'title' => 'برای معرفی کلیک کنید',
                    'input_message_content' => ['parse_mode' => 'HTML', 'message_text' => $DB],
                    'reply_markup' => [
                        'inline_keyboard' =>
                            [['text' => 'ورود به ربات', 'url' => '']]
                    ]
                ]
                ])
            ]);
        }
    }
    $i++;

    sleep(5);
}
getUpdates();

?>


