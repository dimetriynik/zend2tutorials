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
        $query = $entityManager->createQuery('SELECT u FROM ' . Category::class . ' u ORDER BY u.id DESC');
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

                $status = 'success';
                $message = 'категория добавлена';
            } else {
                $status = 'error';
                $message = 'Ошибка запроса';
            }


        } else {
            return compact('form');
        }


        if ($message) {
            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
        }


        return $this->redirect()->toRoute('admin/category');
    }


    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();

        $message = 'Категория удалена';
        $status = 'success';

        try {

            $repository = $em->getRepository(Category::class);
            $category = $repository->find($id);
            $em->remove($category);
            $em->flush();

        } catch (\Exception $ex) {
            $status = 'error';
            $message = 'Ошибка удаления записи ' . $ex->getMessage();
        }


        $this->flashMessenger()
            ->setNamespace($status)
            ->addMessage($message);


        return $this->redirect()->toRoute('admin/category');


    }

    public function editAction()
    {

        $form = new CategoryAddForm();
        $status = $message = '';

        $em = $this->getEntityManager();
        $id = (int)$this->params()->fromRoute('id', 0);

        $category = $em->find(Category::class, $id);

        if (empty($category)) {
            $message = 'Категория не найдена';
            $status = 'error';

            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
            return $this->redirect()->toRoute('admin/category');
        }


        $form->bind($category);
        $request = $this->getRequest();


        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

//                $category->exchangeArray($form->getData());

                $em->persist($category);
                $em->flush();

                $status = 'success';
                $message = 'категория обновлена';
            } else {
                $status = 'error';
                $message = 'Ошибка параметров';

                foreach ($form->getInputFilter()->getInvalidInput() as $errors) {
                    foreach ($errors->getMessages() as $error) {
                        $message .= ' ' . $error;
                    }


                }
            }


        } else {
            return ['form' => $form, 'id' => $id];
        }

        if ($message) {
            $this->flashMessenger()->setNamespace($status)->addMessage($message);


        }

        return $this->redirect()->toRoute('admin/category');


    }

}
