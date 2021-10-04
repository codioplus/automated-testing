<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CheckoutTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call("db:seed");
    }


    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->pause(3000)->press('ul > li:nth-child(1) > a')->pause(3000)->assertSee('Total: $ 3.11');
        });
    }
}
