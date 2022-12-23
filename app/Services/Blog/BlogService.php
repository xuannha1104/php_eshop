<?php

namespace App\Services\Blog;

use App\Repositories\Blog\BlogRepository;
use App\Services\BaseService;

class BlogService extends BaseService implements BlogServiceInterface
{
    protected $repository;
    public function __construct(BlogRepository $blogRepository)
    {
        $this->repository = $blogRepository;
    }
    public function getLatestBlogs(int $limit = 3)
    {
        return $this->repository->getLatestBlogs($limit);
    }


}
