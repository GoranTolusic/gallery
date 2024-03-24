<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Settings;
use App\Models\Contact;
 
class CheckSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->settings = Settings::where('label', 'main_label')->first()->toArray();
        $request->settings['is_authorized'] = $request->session()->get('is_authorized');
        $request->settings['unreadCount'] = Contact::where('isRead', 'no')->count();
        return $next($request);
    }
}