<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return Setting::all();
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.locale' => 'nullable|string|in:ar,he,en',
            'settings.*.value' => 'nullable',
        ]);

        foreach ($request->settings as $s) {
            Setting::set($s['key'], $s['value'], $s['locale'] ?? null);
        }

        return response()->json(['message' => 'Settings updated successfully.']);
    }

    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|max:2048',
        ]);

        $path = $request->file('logo')->store('logos', 'public');
        $url = '/files/' . $path;

        Setting::updateOrCreate(
        ['key' => 'site_logo', 'locale' => null],
        ['value' => $url]
        );

        return response()->json(['logo_url' => $url]);
    }

    public function uploadOgImage(Request $request)
    {
        $request->validate([
            'og_image' => 'required|image|max:2048',
        ]);

        $path = $request->file('og_image')->store('seo', 'public');
        $url = '/files/' . $path;

        Setting::updateOrCreate(
        ['key' => 'seo_og_image', 'locale' => null],
        ['value' => $url]
        );

        return response()->json(['og_image_url' => $url]);
    }

    public function uploadFavicon(Request $request)
    {
        $request->validate([
            // accept typical image formats + ico
            'favicon' => 'required|file|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
        ]);

        $path = $request->file('favicon')->store('seo', 'public');
        $url = '/files/' . $path;

        Setting::updateOrCreate(
        ['key' => 'seo_favicon', 'locale' => null],
        ['value' => $url]
        );

        return response()->json(['favicon_url' => $url]);
    }
}
