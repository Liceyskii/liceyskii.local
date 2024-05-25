<x-main-layout>
    <x-slot name="title">Восстановление аккаунта</x-slot>
    <x-slot name="content">
        <div class="auth-form">
            <form name="recover" action="{{ route('recover.user') }}" method="post">
                @csrf
                @if($message != '')
                    <label for="" style="height: 100px;"></label>
                    {{ $message }}
                @endif
                <label for="login">Логин</label>
                <input type="text" name="login">
                <label for="secret_word">Секретное слово</label>
                <input type="password" name="secret_word">
                <label for="password">Новый пароль</label>
                <input type="password" name="password">
                <label for="confirm-password">Подтвердите пароль</label>
                <input type="password" name="confirm-password">
                <label for=""></label>
                <input type="submit" class="btn">
            </form>
        </div>
    </x-slot>
</x-main-layout>