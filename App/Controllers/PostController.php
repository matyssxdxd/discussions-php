<?php

namespace App\Controllers;

use App\Forms\CommentForm;
use App\Forms\PostForm;
use Core\View;

class PostController extends \App\Models\Post
{

    public function postListRoute(): void
    {
        $posts = $this->getAllPosts();

        if (isset($_SESSION["user"])) {
            foreach($posts as $key=>$value) {
                if ($this->hasUserLiked($value["id"], $_SESSION["user"]["id"])) {
                    $posts[$key]["liked"] = true;
                }

                if ($this->hasUserDisliked($value["id"], $_SESSION["user"]["id"])) {
                    $posts[$key]["disliked"] = true;
                }
            }
        }

        View::render("Post/index.php", [
            "posts" => $posts,
        ]);
    }

    public function showPostRoute(): void
    {
        $postID = $_GET["id"];

        $comments = $this->getComments($postID);
        $post = $this->getPost($postID);
        if ($post) {
            View::render("Post/show.php", [
                "post" => $post,
                "comments" => $comments
            ]);
        } else {
            View::render("404.php");
        }
    }

    public function createPostRoute(): void
    {
        View::render("Post/create.php");
    }

    public function addPost(): void
    {
        PostForm::validate(["title" => $_POST["title"]]);

        $this->storePost($_POST["title"], $_POST["body"], $_SESSION["user"]["username"], $_SESSION["user"]["id"]);
        header("location: /");
    }

    public function likePost(): void
    {
        $postID = (int) $_POST["id"];
        $post = $this->findByID($postID);
        $userID = $_SESSION["user"]["id"];

        if ($this->hasUserLiked($postID, $userID)) {
            $this->removeLiked($postID, $userID);
            $rating = $post["rating"] - 1;
            $this->updateRating($postID, $rating);
            header("location: /");
            die();
        }

        if ($this->hasUserDisliked($postID, $userID)) {
            $this->removeDisliked($postID, $userID);
            $this->addLike($postID, $userID);
            $rating = $post["rating"] + 2;
            $this->updateRating($postID, $rating);
            header("location: /");
            die();
        }

        $rating = $post["rating"] + 1;
        $this->addLike($postID, $userID);
        $this->updateRating($postID, $rating);
        header("location: /");
    }

    public function dislikePost(): void
    {
        $postID = (int) $_POST["id"];
        $post = $this->findByID($postID);
        $userID = $_SESSION["user"]["id"];

        if ($this->hasUserLiked($postID, $userID)) {
            $this->removeLiked($postID, $userID);
            $this->addDislike($postID, $userID);
            $rating = $post["rating"] - 2;
            $this->updateRating($postID, $rating);
            header("location: /");
            die();
        }

        if ($this->hasUserDisliked($postID, $userID)) {
            $this->removeDisliked($postID, $userID);
            $rating = $post["rating"] + 1;
            $this->updateRating($postID, $rating);
            header("location: /");
            die();
        }

        $rating = $post["rating"] - 1;
        $this->addDislike($postID, $userID);
        $this->updateRating($postID, $rating);
        header('location: /');
    }

    public function hasUserDisliked($postID, $userID): bool
    {
        $userDislikedPosts = $this->getUserDisliked($userID);

        foreach ($userDislikedPosts as $userDislikedPost) {
            if ($userDislikedPost["post_id"] === $postID) {
                return true;
            }
        }

        return false;
    }

    public function hasUserLiked($postID, $userID): bool
    {
        $userLikedPosts = $this->getUserLiked($userID);

        foreach ($userLikedPosts as $userLikedPost) {
            if ($userLikedPost["post_id"] === $postID) {
                return true;
            }
        }

        return false;
    }

    public function addComment(): void
    {
        $postID = $_GET["id"];
        $commentBody = $_POST["commentBody"];
        $commentAuthor = $_SESSION["user"]["username"];
        $commentAuthorID = $_SESSION["user"]["id"];

        CommentForm::validate(["body" => $commentBody, "id" => $postID]);

        $this->storeComment($postID, $commentBody, $commentAuthor, $commentAuthorID);

        header("location: /post?id={$postID}");
    }
}