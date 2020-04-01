<?php

namespace App;

/**
 * @Entity 
 * @Table(name="post")
 */

class Post
{
     /**
      * @Id @Column(type="integer") @GeneratedValue
      */
     private $id;

     /**
      * @Column(type="string", length=50)
      */
     private $title;

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
      * @return Post
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
      * @return Post
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
      * @return Post
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
     * Set title.
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
