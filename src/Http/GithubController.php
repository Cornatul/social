<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;



use Cornatul\Social\Service\GithubService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\OAuth2\Client\Provider\Github;


class GithubController extends Controller
{
    private Github $provider;

    private GithubService $service;

    public function __construct()
    {
        $this->provider = new Github([
            'clientId' => config('social.github.clientId'),
            'clientSecret' => config('social.github.clientSecret'),
            'redirectUri' => config('social.github.redirectUri'),
        ]);

        $this->service = new GithubService($this->provider);
    }



    public function index()
    {
        return view('social::github');
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
        session()->put('github_access_token', $accessToken);
        return redirect()->route('social.github.share');
    }



    public function share()
    {
        return view('social::github-share');
    }

    public function shareAction(Request $request)
    {
        $accessToken = session()->get('github_access_token');

        $this->service->shareOnWall($accessToken, $request->input('message'));

        return redirect('social.github.index')->with('success', 'Post shared successfully.');
    }
}
