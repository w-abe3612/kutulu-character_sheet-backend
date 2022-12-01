@extends('layouts.mail')

@section('title', __('登録ありがとうございます'))

@section('content')
<div>
＜＞　様<br>
<br>
この度は「キャラ箱」にご登録いただきありがとうございます。<br>
<br>
現在仮登録の状態となっており、<br>
下記のURLにアクセスしていただく事で本登録が完了いたします。<br>
<a href='{{$url}}'>{{ __('please click this link to verify your email.') }}</a><br>
<br>
お手数ですが、アクセスの程よろしくお願いいたします。<br>
<br>
アクセス後、ログインが可能になりますので、<br>
それから、サービスをご自由にご利用になります。<br>
<br>
では、宇宙の片隅にたまたま生まれただけの虫ケラのような存在の人間様方、<br>
深宇宙の冒涜的な真実をお楽しみ下さい。<br>
<br>
※このメールにお心当たりのない場合は、お手数ですが下記までお問い合わせください。<br>
-----------------------------------------------------------------------------<br>
ツイッターアカウント: @CharaBako<br>
メール　          :<br>
</div>
@endsection