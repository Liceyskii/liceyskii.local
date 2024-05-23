<x-main-layout>
    <x-slot name="title">Авторизация</x-slot>
    <x-slot name="content">
        <div class="auth-form">
            <form name="login" action="{{ route('login.user') }}" method="post">
                @csrf
                @if($message != '')
                    <label for="" style="height: 100px;"></label>
                    {{ $message }}
                @endif
                <label for="login">Логин</label>
                <input type="text" name="login">
                <label for="password">Пароль</label>
                <input type="password" name="password">
                <label for=""></label>
                <input type="submit" class="btn">
            </form>
            <a href="{{ route('register') }}">Регистрация</a>
        </div>
    </x-slot>
</x-main-layout>