<?php

namespace Application\Controllers;

use Application\Model\Article as ArticleModel;
use Application\Model\Category;


class Article extends Controller
{
    public function index()
    {
        $article = new ArticleModel();
        $articles = $article->all();
        return $this->view('panel.article.index', compact('articles'));
    }

    public function create()
    {
        $category = new Category();
        $categories = $category->all();
        return $this->view('panel.article.create', compact('categories'));
    }

    public function store()
    {
        $article = new ArticleModel();

     
        $article_id = $article->insert($_POST);

       
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $total = count($_FILES['images']['name']);
            $targetDir = "uploads/";

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            for ($i = 0; $i < $total; $i++) {
                $tmpFilePath = $_FILES['images']['tmp_name'][$i];
                $fileName = basename($_FILES['images']['name'][$i]);

                if ($tmpFilePath != "") {
                    $targetFilePath = $targetDir . $fileName;

                    if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
                        
                        $article->insertImage($article_id, $targetFilePath);
                    }
                }
            }
        }

        return $this->redirect('article');
    }


    public function show($id) {}

    public function edit($id)
    {
        $category = new Category();
        $categories = $category->all();
        $ob_article = new ArticleModel();
        $article = $ob_article->find($id);
        return $this->view('panel.article.edit', compact('categories', 'article'));
    }

    public function update($id)
    {

        $article = new ArticleModel();
        $article->update($id, $_POST);
        return $this->redirect('article');
    }

    public function destroy($id)
    {
        $article = new ArticleModel();
        $article->delete($id);
        return $this->back();
    }


    public function bulkDestroy()
    {
        $ids = $_POST['ids'] ?? [];

        if (empty($ids)) {
            return $this->back();
        }

        $article = new ArticleModel();
        $article->bulkDelete($ids);

        return $this->back();
    }
}
