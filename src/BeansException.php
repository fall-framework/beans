<?php
namespace fall\beans;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
class BeansException extends \Exception {
  public function __construct(string $message) {
    parent::__construct($message);
  }
}
