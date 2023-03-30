<?php
require_once "../models/config.php";
// require_once "../models/article.php";
class articleC{
    public function addArticle($article){
        try {
            $sql = "INSERT INTO articles (titre, source, contenu, categorie) VALUES (:titre, :source, :contenu, :categorie)";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('titre', $article->gettitreArticle());
            $query->bindValue('source', $article->getsourceArticle());
            $query->bindValue('contenu', $article->getcontenuArticle());
            $query->bindValue('categorie', $article->getcategorieArticle());
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function displayArticles(){
        try {
            $sql = "SELECT * from articles";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteArticle(int $idArticle){
        try {
            $sql = "DELETE from articles where idArticle = ?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idArticle);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function getArticleById($idArticle){
        try {
            $sql = "SELECT * from articles where idArticle=?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idArticle);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updateArticle($idArticle, $article){
        try {
            $sql = "UPDATE articles SET titre = :titre, source = :source,contenu = :contenu, categorie = :categorie WHERE idArticle = :idArticle";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('titre', $article->gettitreArticle());
            $query->bindValue('source', $article->getsourceArticle());
            $query->bindValue('contenu', $article->getcontenuArticle());
            $query->bindValue('categorie', $article->getcategorieArticle());
            $query->bindValue(':idArticle', $idArticle);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function sortArticles(){}
}