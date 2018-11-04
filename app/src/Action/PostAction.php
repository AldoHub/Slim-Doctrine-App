<?php
namespace App\Action;

use Doctrine\ORM\EntityManager;
use App\Entity\Post;
final class PostAction
{
    private $em;

    //instantiate the Entity Manager
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    //get the posts
    public function getPosts($request, $response, $args)
    {
        $posts = $this->em->getRepository('App\Entity\Post')->findAll();
        $posts = array_map(
            function ($post) {
                return $post->getArrayCopy();
            },
            $posts
        );
        return $response->withJSON($posts);
    }

    //get a single post
    public function getPost($request, $response, $args)
    {
        $post = $this->em->getRepository('App\Entity\Post')->find($args['id']);
        if ($post) {
            return $response->withJSON($post->getArrayCopy());
        }
        return $response->withStatus(404)->withJSON(["message" => "There is no post with that ID"]);
    }
   

    //create a post
    public function createPost($request, $response){
         
        $post = new Post();
        $em = $this->em;
      
        $title = $request->getParsedBody()["title"];
        $text = $request->getParsedBody()["text"];
        $slug= $request->getParsedBody()["slug"];

        $post->setTitle($title);
        $post->setText($text);
        $post->setSlug($slug);
        
        $em->persist($post);
        $em->flush();
       
        return $response->withJSON(["message" => "The post has been created"]);

       
    }

    //update a post using the id
    public function updatePost($request, $response, $args){
        $post = $this->em->getRepository('App\Entity\Post')->find($args['id']);

        $title = $request->getParsedBody()["title"];
        $text = $request->getParsedBody()["text"];
        $slug= $request->getParsedBody()["slug"];

        $post->setTitle($title);
        $post->setText($text);
        $post->setSlug($slug);
        $em = $this->em;
        $em->flush();
        return $response->withJSON(["message" => "The post has been updated"]);
    }

    //delete a post using the id
    public function deletePost($request, $response, $args){
        $post = $this->em->getRepository("App\Entity\Post")->find($args["id"]);
        
        //get the EntityManager
        //manage the remove and changes to the database
        $em = $this->em;
        $em->remove($post);
        $em->flush();


        return $response->withJSON([
            "message" => "Post has been deleted",
            "id" => $post->getId(),
            "title" => $post->getTitle(),
            "text" => $post->getText(),
        ]);
    }
}