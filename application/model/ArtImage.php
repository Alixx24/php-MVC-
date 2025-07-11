<?php

namespace Application\Model;

class ArtImage extends Model
{
    public function all()
    {
        $query = "SELECT * FROM article_images";
        return $this->query($query)->fetchAll();
    }

  public function find($id)
{
    $query = "SELECT article_images.*
              FROM article_images
              WHERE article_images.article_id = ?";

    return $this->query($query, [$id])->fetchAll();
}

    public function insert($values)
    {
        $query = "INSERT INTO articles (title, cat_id, body, created_at) VALUES (?, ?, ?, NOW())";
        $this->execute($query, [
            $values['title'],
            $values['cat_id'],
            $values['body']
        ]);
        return $this->connection->lastInsertId();  // استفاده از پراپرتی connection برای گرفتن آخرین آیدی
    }

    public function update($id, $values)
    {
        $query = "UPDATE articles SET title = ?, cat_id = ?, body = ?, updated_at = NOW() WHERE id = ?";
        return $this->execute($query, [
            $values['title'],
            $values['cat_id'],
            $values['body'],
            $id
        ]);
    }

    public function delete($imgId)
    {
       
        $query = "DELETE FROM article_images WHERE id = ?";
        return $this->execute($query, [$imgId]);
    }

    public function insertImage($article_id, $filename)
{
    $query = "INSERT INTO article_images (article_id, filename, uploaded_at) VALUES (?, ?, now())";
    $this->execute($query, [$article_id, $filename]);
}





public function bulkDelete(array $ids)
{
    if (empty($ids)) {
        return false;
    }

    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $query = "DELETE FROM articles WHERE id IN ($placeholders)";
    return $this->execute($query, $ids);
}









}
