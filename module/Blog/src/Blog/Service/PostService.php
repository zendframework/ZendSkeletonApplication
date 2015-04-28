<?php
namespace Blog\Service;

use Blog\Model\Post;

class PostService implements PostServiceInterface
{

    protected $data = array(
        array(
            'id' => 1,
            'title' => 'Hello World #1',
            'text' => 'This is our first blog post!'
        ),
        array(
            'id' => 2,
            'title' => 'Hello World #2',
            'text' => 'This is our second blog post!'
        ),
        array(
            'id' => 3,
            'title' => 'Hello World #3',
            'text' => 'This is our third blog post!'
        ),
        array(
            'id' => 4,
            'title' => 'Hello World #4',
            'text' => 'This is our fourth blog post!'
        ),
        array(
            'id' => 5,
            'title' => 'Hello World #5',
            'text' => 'This is our fifth blog post!'
        )
    );

    /**
     * {@inheritDoc}
     */
    public function findAllPosts()
    {
        $allPosts = array();

        foreach ($this->data as $index => $post) {
            $allPosts[] = $this->findPost($index);
        }

        return $allPosts;
    }

    /**
     * {@inheritDoc}
     */
    public function findPost($id)
    {
        $postData = $this->data[$id];

        $model = new Post();
        $model->setId($postData['id']);
        $model->setTitle($postData['title']);
        $model->setText($postData['text']);

        return $model;
    }
}