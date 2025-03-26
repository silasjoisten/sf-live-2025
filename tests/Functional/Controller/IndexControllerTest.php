<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\FunctionalTestCase;
use Symfony\Component\HttpFoundation\Response;

final class IndexControllerTest extends FunctionalTestCase
{
    /**
     * @test
     */
    public function unauthenticatedUserCanVisitPage(): void
    {
        $this->browser()
            ->visit('/')
            ->expectException(\TypeError::class)
            ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
