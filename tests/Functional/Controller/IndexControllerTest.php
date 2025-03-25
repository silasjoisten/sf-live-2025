<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\FunctionalTestCase;

final class IndexControllerTest extends FunctionalTestCase
{
    /**
     * @test
     */
    public function unauthenticatedUserCanVisitPage(): void
    {
        $this->browser()
            ->visit('/')
            ->assertSuccessful()
            ->assertSeeIn('h1', 'Hello World!');
    }
}
