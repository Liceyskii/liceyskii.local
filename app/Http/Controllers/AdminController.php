<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiting;
use App\Models\Musician;

class AdminController extends Controller
{

    private function accessCheck() {
        if (!session('user') || unserialize(session('user'))->login !== env('ADMIN_LOGIN')) abort(404);
    }

    public function admin() {
        $this->accessCheck();
        $musicians = Musician::where('is_published', 0)->get();
        $voitings = Voiting::where('is_published', 0)->get();
        return view('admin.admin', ['musicians' => $musicians, 'voitings' => $voitings]);
    }

    public function MusicianAccept(Request $request) {
        $this->accessCheck();
        $musician = Musician::where('id', $request['id'])->first();
        $musician->update(['is_published' => true]);
        return redirect()->back();
    }

    public function MusicianDelete(Request $request) {
        $this->accessCheck();
        $musician = Musician::where('id', $request['id'])->first();
        $musician->delete();
        return redirect()->back();
    }

    public function newVoiting(Request $request) {
        $this->accessCheck();
        if ($request['voiting-date']) {
            $voiting = new Voiting;
            $voiting->end_date = $request['voiting-date'];
            $voiting->is_published = true;
            $voiting->save();
            echo 'Новое голосование успешно создано!<br><br>';
        }
        return view('admin.new-voiting');
    }
}
