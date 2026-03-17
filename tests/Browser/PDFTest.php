<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PDFTest extends DuskTestCase
{

      public function test_can_open_pdf()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/nova/resources/pdfs')
                    ->waitFor('@view-pdf-button')
                    ->click('@view-pdf-button')
                    ->pause(2000) // Wait for PDF to load
                    ->screenshot('pdf.png');
        });
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }
}
