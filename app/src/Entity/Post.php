<?php
namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts", uniqueConstraints={@ORM\UniqueConstraint(name="post_slug", columns={"slug"})}))
 */
class Post
{

    public function __construct(){
     
    }
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $slug;


    /**
     * @ORM\Column(type="string", length=250)
     */
    protected $text;

    /**
     * Get array copy of object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Get post id
     *
     * @ORM\return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get post title
     *
     * @ORM\return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get post slug
     *
     * @ORM\return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get text
     *
     * @ORM\return string
     */
    public function getText()
    {
        return $this->text;
    }

    public function setTitle($title){
        $this->title = $title;
     
    }
    public function setText($text){
        $this->text = $text;
       
    }
    public function setSlug($slug){
        $this->slug = $slug;
       
    }
   
  
}