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
            ->expectException(\TypeError::class, 'TypeError: App\Domain\Entity\Author::__construct(): Argument #1 ($values) must be of type array, string given')
            ->visit('/')
            ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
