<h3>Hi! {{ $account->name }}</h3>
<p>Noi dung mail</p>

<p>
    <a href="{{ route('account.verify', ['email'=> $account->email ]) }}">Click here to verify your account</a>
</p>
