<?php

namespace App\Models;

use PDO;

class Post extends \Core\Database
{

    public function getAllPosts()
    {
        return $this->query("SELECT * FROM posts")->findAll();
    }

    public function getPost($postID)
    {
        return $this->query("SELECT * FROM posts WHERE id = :id", [
            "id" => $postID
        ])->find();
    }

    public function storePost($postTitle, $postBody, $author, $authorID): void
    {
        $this->query("INSERT INTO posts (post_title, post_body, author, author_id) VALUES (:post_title, :post_body, :author, :author_id)", [
            "post_title" => $postTitle,
            "post_body" => $postBody,
            "author" => $author,
            "author_id" => $authorID
        ]);
    }

    public function findByID($postID)
    {
        return $this->query("SELECT * FROM posts WHERE id = :id", [
            "id" => $postID
        ])->find();
    }

    public function updateRating($postID, $rating): void
    {
        $this->query("UPDATE posts SET rating = :rating WHERE id = :id", [
            "rating" => $rating,
            "id" => $postID
        ]);
    }

    public function addLike($postID, $userID): void
    {
        $this->query("INSERT INTO liked_posts (user_id, post_id) VALUES (:user_id, :post_id)", [
            "user_id" => $userID,
            "post_id" => $postID
        ]);
    }

    public function addDislike($postID, $userID): void
    {
        $this->query("INSERT INTO disliked_posts (user_id, post_id) VALUES (:user_id, :post_id)", [
            "user_id" => $userID,
            "post_id" => $postID
        ]);
    }

    public function getUserLiked($userID)
    {
        return $this->query("SELECT * FROM liked_posts WHERE user_id = :user_id", [
            "user_id" => $userID
        ])->findAll();
    }

    public function getUserDisliked($userID)
    {
        return $this->query("SELECT * FROM disliked_posts WHERE user_id = :user_id", [
            "user_id" => $userID
        ])->findAll();
    }

    public function removeLiked($postID, $userID): void
    {
        $this->query("DELETE FROM liked_posts WHERE post_id = :post_id AND user_id = :user_id", [
           "post_id" => $postID,
           "user_id" => $userID
        ]);
    }

    public function removeDisliked($postID, $userID): void
    {
        $this->query("DELETE FROM disliked_posts WHERE post_id = :post_id AND user_id = :user_id", [
            "post_id" => $postID,
            "user_id" => $userID
        ]);
    }

    public function storeComment($postID, $body, $author, $author_id): void
    {
        $this->query("INSERT INTO comments (post_id, body, author, author_id) VALUES (:post_id, :body, :author, :author_id)", [
            "post_id" => $postID,
            "body" => $body,
            "author" => $author,
            "author_id" => $author_id
        ]);
    }

    public function getComments($postID)
    {
        return $this->query("SELECT * FROM comments WHERE post_id = :post_id", [
            "post_id" => $postID
        ])->findAll();
    }
}