<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;




use Cornatul\Social\Service\InstagramService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\OAuth2\Client\Provider\Instagram;


class InstagramController extends Controller
{
    private Instagram $provider;

    private InstagramService $service;

    public function __construct()
    {
        $this->provider = new Instagram([
            'clientId' => config('social.instagram.clientId'),
            'clientSecret' => config('social.instagram.clientSecret'),
            'redirectUri' => config('social.instagram.redirectUri'),
        ]);

        $this->service = new InstagramService($this->provider);
    }



    public function index()
    {
        return view('social::instagram.index');
    }

    public function login(Request $request)
    {
        if (!$request->has('code')) {
            $authUrl = $this->service->getAuthUrl();
            return redirect($authUrl);
        }
    }


    //generate callback function

    public function callback(Request $request)
    {
        $accessToken = $this->service->getAccessToken($request->input('code'));
        session()->put('instagram_access_token', $accessToken);
        return redirect()->route('social.instagram.share');
    }



    public function share()
    {
        return view('social::instagram.share');
    }

    public function shareAction(Request $request)
    {
        $accessToken = session()->get('instagram_access_token');

        $this->service->shareOnWall($accessToken, $request->input('message'));

        return redirect('social.instagram.index')->with('success', 'Post shared successfully.');
    }
}
