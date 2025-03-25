<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Entity\Post;
use App\Domain\Value\Slug;
use Storyblok\Api\Domain\Value\Resolver\Relation;
use Storyblok\Api\Domain\Value\Resolver\RelationCollection;
use Storyblok\Api\Request\StoryRequest;
use Storyblok\Api\StoriesApiInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DetailController extends AbstractController
{
    public function __construct(
        private readonly StoriesApiInterface $stories,
    ) {
    }

    #[Route(
        path: '/{slug}',
        name: 'detail',
        requirements: ['slug' => Slug::PATTERN],
        priority: -1000000,
    )]
    public function index(Request $request, string $slug): Response
    {
        $response = $this->stories->bySlug($slug, new StoryRequest(
            language: $request->getLocale(),
            withRelations: new RelationCollection([
                new Relation('post.author'),
                new Relation('post.category'),
            ])
        ));

        return $this->render('detail.html.twig', [
            'post' => new Post($response->story),
        ]);
    }
}
