<?php

namespace App;

/**
 * @Entity 
 * @Table(name="commentaire")
 */

class Commentaire
{
     /**
      * @Id @Column(type="integer") @GeneratedValue
      */
     private $id;

     /**
      * @Column(type="text")
      */
     private $texte;

     /**
      * @Column(type="datetime",nullable=true,options={"default": "CURRENT_TIMESTAMP"})
      */
     private $datepost;

     public function __construct()
     {
          $this->datepost = new \DateTime();
     }

     /**
      * @ManyToOne(targetEntity="Utilisateur")
      * @JoinColumn(nullable=false)
      */
     private $utilisateur;

     /**
      * @ManyToOne(targetEntity="Post")
      * @JoinColumn(nullable=false)
      */
     private $post;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set texte.
     *
     * @param string $texte
     *
     * @return Commentaire
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte.
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set datepost.
     *
     * @param \DateTime|null $datepost
     *
     * @return Commentaire
     */
    public function setDatepost($datepost = null)
    {
        $this->datepost = $datepost;

        return $this;
    }

    /**
     * Get datepost.
     *
     * @return \DateTime|null
     */
    public function getDatepost()
    {
        return $this->datepost;
    }

    /**
     * Set utilisateur.
     *
     * @param \Utilisateur $utilisateur
     *
     * @return Commentaire
     */
    public function setUtilisateur(\App\Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur.
     *
     * @return \Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set post.
     *
     * @param \Post $post
     *
     * @return Commentaire
     */
    public function setPost(\App\Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post.
     *
     * @return \Post
     */
    public function getPost()
    {
        return $this->post;
    }
}
