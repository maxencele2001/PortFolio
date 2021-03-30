<?php

namespace App\Service\Comment;

use App\Entity\Comment;
use App\Repository\CommentRepository;

class CommentService
{
    private $repoComment;

    public function __construct(CommentRepository $repoComment)
    {
        $this->repoComment = $repoComment;
    }

    public function getComments()
    {
        $comments = $this->repoComment->findAllVisible();
        return $comments;
    }

    public function getReplies(Comment $comment)
    {
        $replies = $comment->getRelated();
        return $replies;
    }

    public function getParentComment()
    {
        $parentComment = $this->repoComment->findBy(['related'=>null]);
        return $parentComment;
    }

    public function getAll()
    {
        $all = [];
        $comments = $this->getParentComment();
        foreach($comments as $comment){
            $replies = $this->repoComment->findBy(['related'=>$comment]);
            $all[] = ["comment"=>$comment,"replies"=>$replies];
        }
        return $all;
    }
}