<?php

namespace HyperWP\Domain\Model;

interface AuthorRepository
{
    public function all();
    public function find(int $id);
    public function byUserName(string $userName);
}