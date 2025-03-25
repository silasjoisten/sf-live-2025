<?php

declare(strict_types=1);

namespace App\Resolver;

use App\Domain\Value\Slug;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

#[AutoconfigureTag('controller.argument_value_resolver', ['priority' => 150])]
final readonly class SlugValueResolver implements ValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (Slug::class !== $argument->getType()) {
            return [];
        }

        $value = $request->attributes->get($argument->getName());

        if (!is_string($value)) {
            return [];
        }

        return [new Slug($value)];
    }
}
