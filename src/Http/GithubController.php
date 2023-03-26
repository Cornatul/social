<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;



use Cornatul\Social\Service\GithubService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;


class GithubController extends Controller
{

    private GithubService $service;

    public function __construct()
    {
        $provider =  new Github([
            'clientId' => config('social.github.clientId'),
            'clientSecret' => config('social.github.clientSecret'),
            'redirectUri' => config('social.github.redirectUri'),
        ]);


        $this->service = new GithubService($provider);
    }



    public function index()
    {
        return view('social::github.index');
    }

    /**
     * @throws \Exception
     */
    public function login(Request $request): \Illuminate\Http\RedirectResponse | RuntimeException
    {
        if (!$request->has('code')) {
            $authUrl = $this->service->getAuthUrl();
            return redirect($authUrl);
        }

        throw new \RuntimeException('Code not found');
    }



    /**
     * @throws IdentityProviderException
     */
    public function callback(Request $request)
    {
        $accessToken = $this->service->getAccessToken($request->input('code'));
        session()->put('github_access_token', $accessToken);
        return redirect()->route('social.github.share');
    }



    public function share()
    {
        return view('social::github.share');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \JsonException
     * @throws GuzzleException
     */
    public function shareAction(Request $request)
    {
        $accessToken = session()->get('github_access_token');

        $message = $request->input('message');

        $this->service->createGist($accessToken, $message);

        return redirect('social.github.index')->with('success', 'Post shared successfully.');
    }
}
