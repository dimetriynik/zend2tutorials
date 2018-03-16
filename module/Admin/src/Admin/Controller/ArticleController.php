<?php
/**
 * Created by PhpStorm.
 * User: dev62
 * Date: 16.03.18
 * Time: 15:14
 */

namespace Admin\Controller;


use Application\Controller\BaseAdminController;
use Blog\Entity\Article;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as OrmPaginator;
use Zend\Paginator\Paginator;

class ArticleController extends BaseAdminController
{


    public function indexAction()
    {

        $query = $this->getEntityManager()->createQueryBuilder();

        $query->select('a')
            ->from(Article::class, 'a')
            ->orderBy('a.id', 'DESC');


        $d_paginator = new DoctrineAdapter(new OrmPaginator($query));
        $paginator = new Paginator($d_paginator);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));

        return ['articles' => $paginator];


    }

}