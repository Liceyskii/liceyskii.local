<x-main-layout>
    <x-slot name="title">Регистрация</x-slot>
    <x-slot name="content">
        <div class="auth-form">
            <form name="register" action="{{ route('register.user') }}" method="post">
                @csrf
                @if ($errors->any())
                    <label for=""></label>
                    <style>
                        .auth-form {height: 1100px;}
                    </style>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                @else
                    <style>
                        .auth-form {height: 1050px;}
                    </style>
                @endif
                <label for="login">Логин</label>
                <input type="text" name="login">
                <label for="password">Пароль</label>
                <input type="password" name="password">
                <label for="confirm-password">Подтвердите пароль</label>
                <input type="password" name="confirm-password">
                <label for="secret-word">Секретное слово</label>
                <input type="text" name="secret-word">
                <label for=""></label>
                <div style="display: flex; justify-content: center; align-items: center;">
                    {!! htmlFormSnippet() !!}
                </div>
                <label for=""></label>
                <input type="submit" class="btn">
            </form>
        </div>
    </x-slot>
</x-main-layout>