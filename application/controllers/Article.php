<?php

namespace Application\Controllers;

use Application\Model\Article as ArticleModel;
use Application\Model\Category;
use Application\Model\ArtImage;


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
        $artImg = new ArtImage();
        $articleImg = $artImg->find($id);
      
        $category = new Category();
        $categories = $category->all();
        $ob_article = new ArticleModel();
        $article = $ob_article->find($id);



        return $this->view('panel.article.edit', compact('categories', 'article', 'articleImg'));
    }
public function imageDelete()
{
    // دریافت ورودی خام
    $inputRaw = file_get_contents('php://input');
    error_log("Raw input: " . $inputRaw);

    // دیکد کردن JSON
    $input = json_decode($inputRaw, true);
    error_log("Decoded input: " . print_r($input, true));

    $imgId = $input['id'] ?? null;

    if (!$imgId) {
        echo json_encode(['success' => false, 'message' => 'Photo ID not send']);
        return;
    }

    $artImg = new ArtImage();
    $deleted = $artImg->delete($imgId);

    if ($deleted) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'not deleted']);
    }
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
