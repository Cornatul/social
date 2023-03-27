<?php

namespace Cornatul\Social\Tests\Unit;

use App\Models\User;
use Cornatul\Feeds\Clients\FeedlyClient;
use Cornatul\Feeds\DTO\FeedDto;
use Cornatul\Feeds\Repositories\Interfaces\ArticleRepositoryInterface;
use Cornatul\Feeds\Interfaces\FeedFinderInterface;
use Cornatul\Feeds\Models\Article;
use Cornatul\Feeds\Models\Feed;
use Cornatul\Feeds\Repositories\Interfaces\FeedRepositoryInterface;
use Cornatul\News\DTO\NewsDTO;
use Cornatul\News\Interfaces\NewsInterface;
use Cornatul\Social\Tests\TestCase;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Mockery;


class SocialTest extends TestCase
{


    public function test_news_headlines(): void
    {
        //todo implement this
        $this->assertTrue(true);
    }

}
