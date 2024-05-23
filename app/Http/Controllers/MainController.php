<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Musician;

class MainController extends Controller
{
    public function index() {
        return view('index.index');
    }

    public function about() {
        return view('index.about');
    }

    public function addmusician(Request $request) {
        if (!session('user')) return redirect()->route('login');
        return view('index.add-musician');
    }

    public function addNewMusician(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:musicians|max:255',
            'genre' => 'not_in:null',
            'g-recaptcha-response' => 'recaptcha',
        ], [
            'name.required' => 'Поле "Имя музыканта" обязательное.',
            'name.unique' => 'Артист с таким именем уже существует или проходит модерацию.',
            'name.max' => 'Имя музыканта слишком длинное.',
            'genre.not_in' => 'Поле "Жанр" обязательное.',
            'g-recaptcha-response.recaptcha' => 'Проверка "Я не робот" не пройдена'
        ]);
        $musician = new Musician;
        $musician->name = $validatedData['name'];
        $musician->genre = $validatedData['genre'];
        $musician->is_published = false;
        $musician->votes = 0;
        $musician->save();
        return redirect('addmusician');
    }
}
