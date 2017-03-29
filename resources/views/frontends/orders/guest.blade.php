件名：【倉敷製帽Web受発注システム】ご発注ありがとうございます。<br>
--------------------------------------------------------<br>
<br>
@if ( $tmpEmail['login']['company_name'] != '' && $tmpEmail['email'][0]['WEB納入先名'] != '' )
{{ $tmpEmail['login']['company_name'] }}<br>
{{ $tmpEmail['email'][0]['WEB納入先名'] }} 様<br>
@else
{{ $tmpEmail['login']['company_name'] }}<br>
@endif
<br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
【倉敷製帽Web受発注システム】ご発注を受付しました<br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
<br>
この度は、Web受発注システムをご利用いただきまして、<br>
誠にありがとうございます。<br>
<br>
下記の通り、発注の受付を承りましたので内容をご確認ください。<br>
万一、内容に誤りなどがございましたら、本メールにご返信ください。<br>
<br>
＜ 発注内容  ＞<br>
――――――――――――――――――――――――――――――<br>
@foreach ( $tmpEmail['email'] as $k => $v )
■品番：{{ $v['商品CD'] }}<br>
■商品名：{{ $v['prduct_name'] }}<br>
■カラー：{{ $v['color_name'] }}<br>
■サイズ：{{ $v['size_name'] }}<br>
■数量：{{ $v['数量'] }}<br>
■摘要：{{ $v['注文番号'] }}<br>
<br>
@endforeach
<br>
<br>
＜  担当者情報  ＞<br>
――――――――――――――――――――――――――――――<br>
■担当者名：{{ $tmpEmail['email'][0]['WEB納入先名'] }}<br>
■備考：{!! nl2br($tmpEmail['email'][0]['備考']) !!}<br>
<br>
<br>
＜  メッセージ及び発送方法・発送日時指定  ＞<br>
――――――――――――――――――――――――――――――<br>
■メッセージ：{!! nl2br($tmpEmail['email'][0]['自由欄']) !!}<br>
■出荷方法：<?php foreach ( $tmpEmail['webmkb'] as $item ) {
              if ( $item->ｺｰﾄﾞ == $tmpEmail['email'][0]['出荷まとめ区分'] ) {
                echo $item->名称 . '<br>';
                break;
              }
            } ?>
■便出荷：{{ ($tmpEmail['email'][0]['便出荷区分'] == 1) ? '便を希望する' : '便の希望なし' }}<br>
<br>
<br>
＜ 納入先  ＞<br>
――――――――――――――――――――――――――――――<br>
■納入先名：{{ $tmpEmail['email'][0]['WEB納入先名'] }}<br>
■部署名：{{ $tmpEmail['email'][0]['WEB納入先部署名'] }}<br>
■ご担当者名：{{ $tmpEmail['email'][0]['WEB納入先担当者名'] }}<br>
■郵便番号：{{ $tmpEmail['email'][0]['WEB納入先郵便番号'] }}<br>
■住所：{{ $tmpEmail['email'][0]['WEB納入先住所1'] }}<br>
■住所（ビル名等）：{{ $tmpEmail['email'][0]['WEB納入先住所2'] }}<br>
■電話番号：{{ $tmpEmail['email'][0]['WEB納入先電話番号'] }}<br>
■FAX番号：{{ $tmpEmail['email'][0]['WEB納入先FAX_番号'] }} <br>
■納品書同送：<?php foreach ( $tmpEmail['webdkb'] as $item ) {
              if ( $tmpEmail['email'][0]['WEB納入先納品書同封区分'] == $item->ｺｰﾄﾞ ) {
              echo $item->名称 . '<br>';
              break;
              }
            } ?>
<br>
<br>
今後とも、倉敷製帽Web受発注システムをご愛顧賜りますよう、<br>
よろしくお願い申し上げます。<br>
<br>
************************************************************<br>
倉敷製帽株式会社<br>
──────────────────────────────<br>
 〒710-0043 岡山県倉敷市羽島65-7<br>
 TEL：086-425-3456<br>
 FAX：086-425-0736<br>
 URL:http://kurabou.in/<br>
************************************************************<br>
<br>