件名：【倉敷製帽Web受発注システム】ご発注内容の変更を受付しました。<br>
--------------------------------------------------------<br>
<br>
@if ( $tmpEmail['login']['company_name'] != '' && $tmpEmail['history']->WEB納入先名 != '' )
{{ $tmpEmail['login']['company_name'] }}<br>
{{ $tmpEmail['history']->WEB納入先名 }} 様<br>
@else
{{ $tmpEmail['login']['company_name'] }}<br>
@endif
<br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
【倉敷製帽Web受発注システム】ご発注内容の変更を受付しました。<br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
<br>
この度は、Web受発注システムをご利用いただきまして、<br>
誠にありがとうございます。<br>
<br>
下記の通りご発注内容変更の受付を承りましたので内容をご確認ください。<br>
万一、内容に誤りなどがございましたら、本メールにご返信ください。<br>
<br>
【変更内容】<br>
<br>
＜  メッセージ及び発送方法・発送日時指定  ＞<br>
――――――――――――――――――――――――――――――<br>
■メッセージ：{!! nl2br($tmpEmail['messageChange']['order_content_2_change']) !!}<br>
■出荷方法：@foreach ( $tmpEmail['webmkb'] as $item )
            @if ( $item->ｺｰﾄﾞ == $tmpEmail['messageChange']['order_shipping_change'] )
            {{ $item->名称 }}<br>
            @endif
          @endforeach
■便出荷：@if ( $tmpEmail['messageChange']['order_ship_fly_change'] == 1 )
          便を希望する<br>
          @else
          便の希望なし<br>
          @endif
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