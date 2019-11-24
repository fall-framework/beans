<?php

namespace fall\beans\factory\config;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface BeanDefinitionInterface
{
  public function getBeanClassName(): string;
  public function setBeanClassName(string $beanClassName): void;
  public function getDependsOn(): array;
  public function setDependsOn(array $dependsOn): void;
  public function isAbstract(): bool;
  public function isSingleton(): bool;
  public function isAutowireCandidate(): bool;
  public function setAutowireCandidate(bool $autowireCandidate): void;
}
