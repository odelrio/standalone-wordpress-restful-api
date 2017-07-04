<?php

namespace HyperWP\Domain\Model;

interface TermRepository
{
    public function all(string $type = null);
    public function find(int $id);
    public function ofPost(Post $post, $type = null, $order = null);
}