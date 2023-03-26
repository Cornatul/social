<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;



use Cornatul\Social\Service\GithubService;
use Cornatul\Social\Service\TwitterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use PHPUnit\TextUI\RuntimeException;
use Smolblog\OAuth2\Client\Provider\Twitter;


class TwitterController extends Controller
{
    private Twitter $provider;

    private TwitterService $service;

    public function __construct()
    {
        $this->provider = new Twitter([
            'clientId' => config('social.twitter.clientId'),
            'clientSecret' => config('social.twitter.clientSecret'),
            'redirectUri' => config('social.twitter.redirectUri'),
        ]);

        $this->service = new TwitterService($this->provider);
    }



    public function index()
    {
        return view('social::twitter.index');
    }

    public function login(Request $request): RedirectResponse | RuntimeException
    {
        if (!$request->has('code')) {
            $authUrl = $this->service->getAuthUrl();
            return redirect($authUrl);
        }
        throw new \RuntimeException('Request does not have code.');
    }


    /**
     * @throws IdentityProviderException
     */
    public function callback(Request $request): RedirectResponse
    {
        $accessToken = $this->service->getAccessToken($request->input('code'));
        session()->put('twitter_access_token', $accessToken);
        return redirect()->route('social.twitter.share');
    }

    public function share()
    {
        return view('social::twitter.share');
    }

    public function shareAction(Request $request)
    {
        $accessToken = session()->get('twitter_access_token');

        $this->service->shareOnWall($accessToken, $request->input('message'));

        return redirect('social.twitter.index')->with('success', 'Post shared successfully.');
    }
}
