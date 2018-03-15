<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category_key", type="string", length=20, nullable=true)
     */
    private $categoryKey;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", length=200, nullable=true)
     */
    private $categoryName;


}
