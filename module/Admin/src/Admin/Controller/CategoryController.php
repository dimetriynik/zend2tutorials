<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;


use Admin\Form\CategoryAddForm;
use Blog\Entity\Category;
use Zend\View\Model\ViewModel;
use Application\Controller\BaseAdminController as BaseController;

class CategoryController extends BaseController
{
    public function indexAction()
    {


        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT u FROM \Blog\Entity\Category u ORDER BY u.id DESC');
        $rows = $query->getResult();


        return ['categories' => $rows];
    }


    public function addAction()
    {
        $form = new CategoryAddForm();
        $status = $message = '';

        $em = $this->getEntityManager();

        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {
                $category = new Category();
                $category->exchangeArray($form->getData());

                $em->persist($category);
                $em->flush();

                $status = 'Success';
                $message = 'категория добавлена';
            } else {
                $status = 'error';
                $message = 'Ошибка запроса';
            }


        } else {
            return compact('form');
        }


        if($message)
        {
            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
        }


        return $this->redirect()->toRoute('admin/category');
    }


    public function deleteAction()
    {

    }


    public function editAction()
    {

    }

}
