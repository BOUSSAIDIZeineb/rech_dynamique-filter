<?php
class article{
    private int $idArticle ;
    private string $titre;
    private string $source;
    private string $contenu;
    private string $categorie;

    public function getidArticle (){
        return $this->idArticle;
    }
    public function gettitreArticle (){
        return $this->titre;
    }
    public function getsourceArticle (){
        return $this->source;
    }
    public function getcontenuArticle (){
        return $this->contenu;
    }
    public function getcategorieArticle (){
        return $this->categorie;
    }
    
    public function __construct(string $titre='',string $source='',string $contenu='',string $categorie=''){
        $this->titre=$titre;
        $this->source=$source;
        $this->contenu=$contenu;
        $this->categorie=$categorie;
    }
}