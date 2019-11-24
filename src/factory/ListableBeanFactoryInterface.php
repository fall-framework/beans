<?php

namespace fall\beans\factory;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface ListableBeanFactoryInterface extends BeanFactoryInterface
{
  function getBeanNamesForType(string $type): array;
  function containsBeanDefinition(string $beanName): bool;
}
