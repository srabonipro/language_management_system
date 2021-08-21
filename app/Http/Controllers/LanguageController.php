<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::get();
        return view('language.index', compact('languages'));
    }

    public function create()
    {
        return view('language.create');
    }

    public function store(Request $request)
    {
        $language = Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'slug' => Str::slug($request->name)
        ]);

        if ($language) {
            $baseFile = base_path('resources/lang/default.json');
            $fileName = base_path('resources/lang/' . Str::slug($request->name) . '.json');
            copy($baseFile, $fileName);
        }
        return back();
    }

    public function transUpdate(Request $request)
    {
        \Log::debug($request->all());
        $language = Language::findOrFail($request->lang_id);
        $data = file_get_contents(base_path('resources/lang/' . $language->slug . '.json'));

        $translations = json_decode($data, true);

        foreach ($translations as $key => $value) {
            if ($request->$key) {
                $translations[$key] = $request->$key;
            } else {
                $translations[$key] = "";
            }
        }

        file_put_contents(base_path('resources/lang/' . $language->slug . '.json'), json_encode($translations, JSON_PRETTY_PRINT));
        file_put_contents(base_path('resources/lang/' . $language->slug . '.json'), json_encode($translations));
        return back();
    }


    public function test()
    {
        // Read File
        $jsonString = file_get_contents(base_path('resources/lang/en.json'));
        $data = json_decode($jsonString, true);

        // Update Key
        $data['country.title'] = "Change Manage Country";

        // Write File
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/lang/en.json'), stripslashes($newJsonString));

        // Get Key Value
        dd(__('country.title'));
    }

    public function langView(Language $language)
    {
        $path = base_path('resources/lang/' . $language->slug . '.json');
        $translations = json_decode(file_get_contents($path), true);
        return view('language.lang_view', compact('language', 'translations'));

        // \Log::debug($translations);
    }

    public function setLanguage($language)
    {
        \Log::info($language);

        $languagesArray = Language::pluck('slug')->toArray();

        if (!in_array($language, $languagesArray)) {
            abort(400);
        }

        \Log::info('set translation');

        App::setLocale($language);

        //
        return redirect()->back();
    }
}
