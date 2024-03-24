<?php
 
namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\PictureService;
use App\Models\Picture;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
 
class PageController extends Controller
{
    public function __construct(PictureService $service) {
        $this->pictureService = $service;
    }

    public function home(Request $request): View
    {
        $settings = $request->settings;
        $quote = $settings['quote'];
        $quoteAuthor = null;

        if (!$quote) {
            $generatedQuote = handleInspirationalQuote();
            $quote = $generatedQuote['quote'];
            $quoteAuthor = $generatedQuote['quoteAuthor'];
        }

        return view('page.home', ['quote' => $quote, 'quoteAuthor' => $quoteAuthor, 'settings' => $settings]);
    }

    public function about(Request $request): View
    {
        return view('page.about', ['settings' => $request->settings]);
    }

    public function contact(Request $request): View
    {
        return view('page.contact', ['settings' => $request->settings]);
    }

    public function contactMe(Request $originalRequest, ContactRequest $request, Contact $contact): View
    {
        $validated = $request->validated();
        $created = $contact->create($validated);
        return view('page.contact', ['settings' => $originalRequest->settings, 'validated' => $validated, 'created' => $created]);
    }

    public function pictures(Request $request, Picture $picture): View
    {
        $pictures = $this->pictureService->filter($request, $picture);
        return view('page.pictures', ['settings' => $request->settings, 'pictures' => $pictures]);
    }

    public function picture($id, Request $request): View
    {
        $result = $this->pictureService->getOne($id);
        if (!$result) abort(404, 'Not Found');
        return view('page.picture', ['settings' => $request->settings, 'picture' => $result]);
    }

}