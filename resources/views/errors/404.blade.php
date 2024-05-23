<x-main-layout>
    <x-slot name="title">Страница не найдена</x-slot>
    <x-slot name="content">
        <div class="content">
            <div class="text-block">
                <h1>Страница не найдена: 404</h1>
                <div class="hr"></div>
                <div class="auth-form">
                <a href="{{ route('index') }}">Вернуться на главную</a>
                </div>
                
            </div>
        </div>
    </x-slot>
</x-main-layout>