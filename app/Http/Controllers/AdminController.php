<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SaveSettingsRequest;
use App\Http\Requests\AddPictureRequest;
use App\Http\Requests\UpdatePictureRequest;
use App\Models\Settings;
use App\Models\Picture;
use App\Services\PictureService;


class AdminController extends Controller
{
    public function __construct(PictureService $service)
    {
        $this->pictureService = $service;
    }

    public function login(Request $request, LoginRequest $loginRequest)
    {
        $validated = $loginRequest->validated();
        if ($validated['password'] !== env('ADMIN_PASSWORD')) {
            return redirect()->route('adminLogin')->with('invalidPassword', true);
        }
        $request->session()->put('is_authorized', true);
        return redirect()->route('settingsPanel');
    }

    public function loginPage(Request $request)
    {
        if ($request->session()->get('is_authorized')) {
            return redirect()->route('settingsPanel');
        }
        return view('admin.loginPage', ['settings' => $request->settings]);
    }

    public function logout(Request $request)
    {
        $request->session()->put('is_authorized', false);
        return redirect()->route('adminLogin');
    }

    public function settingsPanel(Request $request): View
    {
        return view('admin.settingsPanel', ['settings' => $request->settings]);
    }

    public function saveSettings(Request $request, SaveSettingsRequest $settingsRequest, Settings $settings)
    {
        $validated = $settingsRequest->validated();

        $profilePicture = $request->file('profile_picture');
        if ($profilePicture) {
            $fileName = $profilePicture->getClientOriginalName();
            $file_path = public_path('profile-picture/' . $request->settings['profile_picture']);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $profilePicture->move(public_path('profile-picture'), $fileName);
            $validated['profile_picture'] = $fileName;
        }

        $backgroundPicture = $request->file('background_picture');
        if ($backgroundPicture) {
            $fileName = $backgroundPicture->getClientOriginalName();
            $file_path = public_path('background-picture/' . $request->settings['home_banner_picture']);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $backgroundPicture->move(public_path('background-picture'), $fileName);
            $validated['home_banner_picture'] = $fileName;
        }

        $found = $settings->where('label', 'main_label')->first();
        $found->update($validated);
        return redirect()->route('settingsPanel');
    }

    public function imagesPanel(Request $request, Picture $picture): View
    {
        $pictures = $this->pictureService->filter($request, $picture);
        return view('admin.imagesPanel', ['settings' => $request->settings, 'pictures' => $pictures]);
    }

    public function messagesPanel()
    {

    }

    public function addImage(Request $request, AddPictureRequest $addPictureRequest, Picture $picture)
    {
        $validated = $addPictureRequest->validated();
        $imagePicture = $request->file('main_picture');
        if ($imagePicture) {
            $validated['url_path'] = $this->pictureService->storePictureFile($imagePicture);
            $this->pictureService->handleThumbnail($validated);
        }
        $picture->create($validated);
        return redirect()->route('imagesPanel');
    }

    public function deleteImage($id)
    {
        $found = $this->pictureService->deletePictureFile($id);
        $found->delete();
        return redirect()->route('imagesPanel');
    }

    public function editImage($id, UpdatePictureRequest $updatePictureRequest)
    {
        $validated = $updatePictureRequest->validated();
        $imagePicture = $updatePictureRequest->file('main_picture');
        if ($imagePicture) {
            $this->pictureService->deletePictureFile($id);
            $validated['url_path'] = $this->pictureService->storePictureFile($imagePicture);
            $this->pictureService->handleThumbnail($validated);
        }
        $picture = Picture::find($id);
        $picture->update($validated);
        return redirect()->route('imagesPanel');
    }
}
