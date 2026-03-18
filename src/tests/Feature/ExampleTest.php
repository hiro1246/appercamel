<?php

namespace Tests\Feature;

use App\Models\appercamel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_is_redirected_to_admin_after_login()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_view_contact_list()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $contact = appercamel::factory()->create([
            'name' => '山田 太郎',
            'email' => 'yamada@example.com',
            'content' => 'テストお問い合わせ',
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('お問い合わせ内容一覧');
        $response->assertSee($contact->name);
        $response->assertSee($contact->email);
        $response->assertSee('テストお問い合わせ');
    }

    public function test_admin_can_search_by_name()
    {
        /** @var User $user */
        $user = User::factory()->create();

        appercamel::factory()->create(['name' => '山田 太郎']);
        appercamel::factory()->create(['name' => '佐藤 花子']);

        $response = $this->actingAs($user)->call('GET', '/admin', ['name' => '山田']);
        $response->assertStatus(200);
        $response->assertSee('山田 太郎');
        $response->assertDontSee('佐藤 花子');
    }

    public function test_admin_can_search_by_email()
    {
        /** @var User $user */
        $user = User::factory()->create();

        appercamel::factory()->create(['email' => 'target@example.com']);
        appercamel::factory()->create(['email' => 'other@example.com']);

        $response = $this->actingAs($user)->get('/admin?email=target');
        $response->assertStatus(200);
        $response->assertSee('target@example.com');
        $response->assertDontSee('other@example.com');
    }

    public function test_admin_can_search_by_gender()
    {
        /** @var User $user */
        $user = User::factory()->create();

        appercamel::factory()->create(['name' => '男性ユーザー', 'gender' => '1']);
        appercamel::factory()->create(['name' => '女性ユーザー', 'gender' => '2']);

        $response = $this->actingAs($user)->get('/admin?gender=1');
        $response->assertStatus(200);
        $response->assertSee('男性ユーザー');
        $response->assertDontSee('女性ユーザー');
    }

    public function test_admin_can_search_by_inquiry_type()
    {
        /** @var User $user */
        $user = User::factory()->create();

        appercamel::factory()->create(['name' => '配送問合せ', 'inquiry_type' => 'delivery']);
        appercamel::factory()->create(['name' => 'その他問合せ', 'inquiry_type' => 'other']);

        $response = $this->actingAs($user)->get('/admin?inquiry_type=delivery');
        $response->assertStatus(200);
        $response->assertSee('配送問合せ');
        $response->assertDontSee('その他問合せ');
    }

    public function test_admin_can_search_by_date()
    {
        /** @var User $user */
        $user = User::factory()->create();

        appercamel::factory()->create([
            'name' => '昨日の問合せ',
            'created_at' => now()->subDay(),
        ]);
        appercamel::factory()->create([
            'name' => '今日の問合せ',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/admin?date=' . now()->toDateString());
        $response->assertStatus(200);
        $response->assertSee('今日の問合せ');
        $response->assertDontSee('昨日の問合せ');
    }

    public function test_admin_blank_search_returns_all_contacts()
    {
        /** @var User $user */
        $user = User::factory()->create();

        appercamel::factory()->create(['name' => 'ユーザーA']);
        appercamel::factory()->create(['name' => 'ユーザーB']);

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('ユーザーA');
        $response->assertSee('ユーザーB');
    }

    public function test_admin_contact_list_is_paginated_by_seven_items()
    {
        /** @var User $user */
        $user = User::factory()->create();

        for ($index = 1; $index <= 8; $index++) {
            appercamel::factory()->create([
                'name' => 'お問い合わせ' . $index,
                'email' => 'contact' . $index . '@example.com',
                'content' => '内容' . $index,
            ]);
        }

        $firstPage = $this->actingAs($user)->get('/admin');
        $firstPage->assertStatus(200);
        $firstPage->assertDontSee('内容1');

        $secondPage = $this->actingAs($user)->get('/admin?page=2');
        $secondPage->assertStatus(200);
        $secondPage->assertSee('内容1');
    }
}
