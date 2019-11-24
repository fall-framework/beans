<?php

namespace fall\beans\factory;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface BeanFactoryInterface
{
  public function containsBean(string $name): bool;
  public function getBeanByType(string $requiredType);
  public function getBeanByName(string $name): object;
}
