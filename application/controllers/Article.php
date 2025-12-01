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
        print_r('asd');
        $category = new Category();
        $categories = $category->all();
        return $this->view('panel.article.create', compact('categories'));
    }

    public function store()
    {
        $article = new ArticleModel();


        $id = $article->insert($_POST);

        $article->update($id, $_POST);

        $this->imageArticleHandler($id, $_FILES);
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

        $inputRaw = file_get_contents('php://input');


        $input = json_decode($inputRaw, true);

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

    public function update($id)
    {
        $article = new ArticleModel();
        $article->update($id, $_POST);

        $this->imageArticleHandler($id, $_FILES); 

        return $this->redirect('article');
    }

    public function imageArticleHandler($article_id, $files)
    {
        $article = new ArticleModel();

        if (isset($files['images']) && !empty($files['images']['name'][0])) {

            $total = count($files['images']['name']);
            $targetDir = "uploads/";

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            for ($i = 0; $i < $total; $i++) {
                $tmpFilePath = $files['images']['tmp_name'][$i];
                $fileName = basename($files['images']['name'][$i]);

                if ($tmpFilePath != "") {
                    $targetFilePath = $targetDir . $fileName;

                    if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
                        $article->insertImage($article_id, $targetFilePath);
                    }
                }
            }
        }
    }





    public function uploadCkeditorImage()
{
    global $base_url;
    if (isset($_FILES['upload'])) {
        $uploadDir = 'public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = time() . '_' . basename($_FILES['upload']['name']);
        $targetFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['upload']['tmp_name'], $targetFile)) {
            $funcNum = $_GET['CKEditorFuncNum'];
            $url = $base_url . 'public/uploads/' . $filename;  
            echo "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '');</script>";
        } else {
            echo "<script>alert('خطا در آپلود تصویر');</script>";
        }
    }
}

}
