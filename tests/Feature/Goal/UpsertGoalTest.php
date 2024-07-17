<?php

namespace Tests\Feature\Goal;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class UpsertGoalTest extends TestCase
{
    private const URL = '/api/goal/update';
    private User $user;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        // 認証済みのテストユーザーを作成
        $this->user = User::query()->first();
    }

    /**
     * @noinspection NonAsciiCharacters
     */
    #[Test]
    public function  正常に目標設定ができることを確認(): void
    {
        $this->actingAs($this->user);
        $response = $this->putJson(self::URL, [
            'goal' => [
                'calorie' => 2000,
                'protein' => 100,
                'fat' => 50,
                'carbohydrate' => 300,
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => '目標を設定しました']);
        $this->assertDatabaseHas('goals', [
            'user_id' => $this->user->id,
            'calorie' => 2000,
            'protein' => 100,
            'fat' => 50,
            'carbohydrate' => 300,
        ]);
    }

    /**
     * @noinspection NonAsciiCharacters
     */
    #[Test]
    public function 未ログインの場合は目標設定ができないこと(): void
    {
        $response = $this->putJson(self::URL, [
            'goal' => [
                'calorie' => 2000,
                'protein' => 100,
                'fat' => 50,
                'carbohydrate' => 300,
            ],
        ]);

        $response->assertStatus(ResponseAlias::HTTP_UNAUTHORIZED);
    }

    /**
     * @noinspection NonAsciiCharacters
     * @param array{goal: array{calorie: int|null, protein: int|null, fat: int|null, carbohydrate: int|null}} $data
     * @param array{field: string, message: string} $validationMessage
     */
    #[Test]
    #[DataProvider('failedUpsertGoalProvider')]
    public function 不正なデータの時に、目標設定ができないこと($data, $validationMessage): void
    {
        $this->actingAs($this->user);
        $response = $this->putJson(self::URL, ['goal' => $data]);

        $response->assertStatus(ResponseAlias::HTTP_BAD_REQUEST);
        $response->assertJson(
            fn (AssertableJson $json) => $json
                ->has(
                    'errors',
                    fn (AssertableJson $json) => $json->where('goal.'.$validationMessage['field'], [$validationMessage['message']])
                        ->etc()
                )
                ->etc()
        );
    }

    /**
     * @return array{string: array{goal: array{calorie: int|null, protein: int|null, fat: int|null, carbohydrate: int|null},
     * field: string,
     * message: string}[]}
     */
    public static function failedUpsertGoalProvider(): array
    {
        return [
            'calorieが未入力' => [
                [
                    'calorie' => null,
                    'protein' => 100,
                    'fat' => 50,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'calorie',
                    'message' => 'カロリーは必須です。',
                ]
            ],
            'calorieが整数でない' => [
                [
                    'calorie' => 'string',
                    'protein' => 100,
                    'fat' => 50,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'calorie',
                    'message' => 'カロリーは整数でなければなりません。',
                ]
            ],
            'calorieが0未満' => [
                [
                    'calorie' => -1,
                    'protein' => 100,
                    'fat' => 50,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'calorie',
                    'message' => 'カロリーは0以上でなければなりません。',
                ]
            ],
            'calorieが9999より大きい' => [
                [
                    'calorie' => 10000,
                    'protein' => 100,
                    'fat' => 50,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'calorie',
                    'message' => 'カロリーは9999以下でなければなりません。',
                ]
            ],
            'proteinが未入力' => [
                [
                    'calorie' => 2000,
                    'protein' => null,
                    'fat' => 50,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'protein',
                    'message' => 'タンパク質は必須です。',
                ]
            ],
            'proteinが整数でない' => [
                [
                    'calorie' => 2000,
                    'protein' => 'string',
                    'fat' => 50,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'protein',
                    'message' => 'タンパク質は整数でなければなりません。',
                ]
            ],
            'proteinが0未満' => [
                [
                    'calorie' => 2000,
                    'protein' => -1,
                    'fat' => 50,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'protein',
                    'message' => 'タンパク質は0以上でなければなりません。',
                ]
            ],
            'proteinが9999より大きい' => [
                [
                    'calorie' => 2000,
                    'protein' => 10000,
                    'fat' => 50,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'protein',
                    'message' => 'タンパク質は9999以下でなければなりません。',
                ]
            ],
            'fatが未入力' => [
                [
                    'calorie' => 2000,
                    'protein' => 100,
                    'fat' => null,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'fat',
                    'message' => '脂質は必須です。',
                ]
            ],
            'fatが整数でない' => [
                [
                    'calorie' => 2000,
                    'protein' => 100,
                    'fat' => 'string',
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'fat',
                    'message' => '脂質は整数でなければなりません。',
                ]
            ],
            'fatが0未満' => [
                [
                    'calorie' => 2000,
                    'protein' => 100,
                    'fat' => -1,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'fat',
                    'message' => '脂質は0以上でなければなりません。',
                ]
            ],
            'fatが9999より大きい' => [
                [
                    'calorie' => 2000,
                    'protein' => 100,
                    'fat' => 10000,
                    'carbohydrate' => 300,
                ],
                [
                    'field' => 'fat',
                    'message' => '脂質は9999以下でなければなりません。',
                ]
            ],
            'carbohydrateが未入力' => [
                [
                    'calorie' => 2000,
                    'protein' => 100,
                    'fat' => 50,
                    'carbohydrate' => null,
                ],
                [
                    'field' => 'carbohydrate',
                    'message' => '炭水化物は必須です。',
                ]
            ],
            'carbohydrateが整数でない' => [
                [
                    'calorie' => 2000,
                    'protein' => 100,
                    'fat' => 50,
                    'carbohydrate' => 'string',
                ],
                [
                    'field' => 'carbohydrate',
                    'message' => '炭水化物は整数でなければなりません。',
                ]
            ],
            'carbohydrateが0未満' => [
                [
                    'calorie' => 2000,
                    'protein' => 100,
                    'fat' => 50,
                    'carbohydrate' => -1,
                ],
                [
                    'field' => 'carbohydrate',
                    'message' => '炭水化物は0以上でなければなりません。',
                ]
            ],
            'carbohydrateが9999より大きい' => [
                [
                    'calorie' => 2000,
                    'protein' => 100,
                    'fat' => 50,
                    'carbohydrate' => 10000,
                ],
                [
                    'field' => 'carbohydrate',
                    'message' => '炭水化物は9999以下でなければなりません。',
                ]
            ],
        ];
    }
}
