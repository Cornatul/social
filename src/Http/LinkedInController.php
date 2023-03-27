<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;



use Cornatul\Social\Objects\Message;
use Cornatul\Social\Service\LinkedInService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\LinkedIn;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


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
        return redirect()->route('social.linkedin.index');
    }


    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws GuzzleException
     * @throws IdentityProviderException
     * @throws \JsonException
     */
    public function shareAction(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'summary' => 'required',
            'message' => 'required',
            'image' => 'required',
        ]);

        //todo inspect this code for the posting to see why it doesn't pick up the image
        $accessToken = session()->get('linkedin_access_token');

        $message = new Message();

        $message->setTitle($request->input('title'));
        $message->setUrl($request->input('url'));
        $message->setSummary($request->input('summary'));
        $message->setBody($request->input('message'));
        $message->setImage($request->input('image'));

        $this->service->shareOnWall($accessToken, $message);

        return redirect(route('social.linkedin.index'))->with('success', 'Post shared successfully.');
    }
}
