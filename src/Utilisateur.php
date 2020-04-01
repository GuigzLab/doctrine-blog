<?php

namespace App;

/**
 * @Entity 
 * @Table(name="utilisateur")
 */

class Utilisateur
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=30)
     */
    private $login;
    /**
     * @Column(type="string", length=255)
     */
    private $passwd;

    /**
     * @Column(type="string", length=20,nullable=true,options={"default": "user"})
     */
    private $role;

    public function __construct()
    {
        $this->role = 'user';
    }

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
     * Set login.
     *
     * @param string $login
     *
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set passwd.
     *
     * @param string $passwd
     *
     * @return Utilisateur
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }

    /**
     * Get passwd.
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Set role.
     *
     * @param string|null $role
     *
     * @return Utilisateur
     */
    public function setRole($role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role.
     *
     * @return string|null
     */
    public function getRole()
    {
        return $this->role;
    }
}
