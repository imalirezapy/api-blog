<?php

namespace Tests\Feature\Modules\Blog;

use Database\Seeders\ArticleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Testing\Fluent\AssertableJson;
use Modules\Blog\Entities\Article;
use Modules\Blog\Entities\Category;
use Tests\ResponseMetaStructure;
use Tests\TestCase;
use Tests\WithUser;

class ShowAllArticlesTest extends TestCase
{
    use RefreshDatabase,
        ResponseMetaStructure,
        ArticleStructure,
        WithUser;


    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpUser();
        $this->seed(ArticleSeeder::class);
    }

    public function testSuccessfulAuthenticatedUserFetchArticles(): void
    {
        $response = $this->actingAs($this->user)
            ->getJson(route('article.index'));

        $response->assertOk()
            ->assertJsonStructure([
                ...$this->responsePaginatedStructure,
                'data' => [
                    '*' => $this->articleStructure
                ]
            ]);
    }

    public function testSuccessfulPerPageParamEnabled(): void
    {
        $perPage = 5;

        $response = $this->actingAs($this->user)
            ->getJson(route('article.index', [
                'perPage' => $perPage,
                ])
            );

        $response->assertOk()
            ->assertJsonCount($perPage, 'data')
            ->assertJson([
                'meta' => [
                    'per_page' => 5,
                ]
            ]);
    }

    public function testSuccessfulSearchParamWorking(): void
    {
        $article = Article::factory()->createOne([
            'title' => 'specific title for search 123',
            'category_id' => Category::factory()->createOne()->id,
        ]);

        $response = $this->actingAs($this->user)
                ->getJson(route('article.index', [
                    'search' => 'search 123',
                ]));

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $article->id);
    }

    public function testSuccessfulFetchByCategoryId(): void
    {
        $category = Category::inRandomOrder()->first();

        $response = $this->actingAs($this->user)
            ->getJson(route(
                'article.index',
                [
                    'category_id' => $category->id
                ]
            ));

        $response->assertOk();

        $categoryIds = collect($response->json()['data'])->pluck('category_id');
        $this->assertTrue($categoryIds->every(function ($categoryId) use ($category) {
            return $categoryId === $category->id;
        }));
    }
}
