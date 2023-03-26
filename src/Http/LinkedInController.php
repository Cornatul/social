<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;



use Cornatul\Social\Service\LinkedInService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\OAuth2\Client\Provider\LinkedIn;


class LinkedInController extends Controller
{
    private LinkedIn $provider;

    private LinkedInService $service;

    public function __construct()
    {
        $this->provider = new LinkedIn([
            'clientId' => config('social.linkedin.clientId'),
            'clientSecret' => config('social.linkedin.clientSecret'),
            'redirectUri' => config('social.linkedin.redirectUri'),
        ]);

        $this->service = new LinkedInService($this->provider);
    }



    public function index()
    {
        return view('social::linkedin.index');
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
        session()->put('linkedin_access_token', $accessToken);
        return redirect()->route('social.linkedin.share');
    }



    public function share()
    {
        return view('social::linkedin.share');
    }

    public function shareAction(Request $request)
    {
        $accessToken = session()->get('linkedin_access_token');
        $this->service->shareOnWall($accessToken, $request->input('message'));
        return redirect('social.linkedin.index')->with('success', 'Post shared successfully.');
    }
}
