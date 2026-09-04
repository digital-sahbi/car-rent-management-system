<?php

namespace Tests\Feature;

use Tests\TestCase;

class PaymentChoiceTest extends TestCase
{
    public function test_payment_choice_page_shows_cash_and_card_options(): void
    {
        $response = $this->get('/payment/method?price=8000&product=1');

        $response->assertStatus(200)
            ->assertSee('Cash on delivery')
            ->assertSee('Bank card');
    }
}
