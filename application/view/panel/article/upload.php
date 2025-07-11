<?php
if (isset($_FILES['upload'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = basename($_FILES['upload']['name']);
    $targetFile = $uploadDir . time() . '_' . $filename; // جلوگیری از تکرار اسم

    if (move_uploaded_file($_FILES['upload']['tmp_name'], $targetFile)) {
        $funcNum = $_GET['CKEditorFuncNum'];
        $url = '/' . $targetFile;
        echo "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '');</script>";
    } else {
        echo "<script>alert('خطا در آپلود تصویر');</script>";
    }
}
?>
