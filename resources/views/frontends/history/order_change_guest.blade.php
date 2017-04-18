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
＜ 納入先  ＞<br>
――――――――――――――――――――――――――――――<br>
■納入先名：{{ $tmpEmail['orderChange']['order_name'] }}<br>
■部署名：{{ $tmpEmail['orderChange']['order_division'] }}<br>
■ご担当者名：{{ $tmpEmail['orderChange']['order_member'] }}<br>
■郵便番号：{{ $tmpEmail['orderChange']['order_zip3'] }}-{{ $tmpEmail['orderChange']['order_zip4'] }}<br>
■住所：{{ $tmpEmail['orderChange']['order_address1'] }}<br>
■住所（ビル名等）：{{ $tmpEmail['orderChange']['order_address2'] }}<br>
■電話番号：{{ $tmpEmail['orderChange']['order_tel'] }}<br>
■FAX番号：{{ $tmpEmail['orderChange']['order_fax'] }}<br>
■納品書同送：@foreach ( $tmpEmail['webdkb'] as $item )
            @if ( $tmpEmail['orderChange']['order_invoice'] == $item->ｺｰﾄﾞ )
            {{ $item->名称 }}<br>
            @endif
          @endforeach
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