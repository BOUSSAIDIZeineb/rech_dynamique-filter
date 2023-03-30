<?php
require "../controllers/articleC.php";
require "../models/article.php";
$articleC = new articleC();
$listArticles = $articleC->displayArticles();
$updateArticle = NULL;

if(isset($_GET["removeArticle"])&&!empty($_GET["removeArticle"])){
    $articleC->deleteArticle($_GET["removeArticle"]);
    header('location: http://localhost/ateliercrudsmoh%20-%20Copie%20-%20Copie/views/');
}

if(isset($_POST)&&!empty($_POST)){
    if(isset($_GET["updateArticle"])&&!empty($_GET["updateArticle"])){
        $article = new article($_POST["titre"], $_POST["source"], $_POST["contenu"],$_POST["categorie"]);
        $articleC->updateArticle($_GET["updateArticle"], $article);
    }
    else{
        $article = new article($_POST["titre"], $_POST["source"], $_POST["contenu"], $_POST["categorie"]);
        $articleC->addArticle($article);
    }  
    header('location: http://localhost/ateliercrudsmoh%20-%20Copie%20-%20Copie/views/');
}

if(isset($_GET["updateArticle"])&&!empty($_GET["updateArticle"])){
    $updateArticle = $articleC->getArticleById($_GET["updateArticle"]);    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHt0A93w35dYTsvhlPVnYs9eStHfGJv0vKxVfELGroGKvsg+p" crossorigin="anonymous" /> -->
    <!-- ******************** -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <!-- ******************** -->
    <style>
    .removeBtn {
        background-color: red;
        color: white;
    }

    .updateBtn {
        background-color: green;
        color: white;
    }
    </style>

    <!-- **********filter*********** -->
    <link rel="stylesheet" href="./css_final.css">
    <script src="./filter.js"></script>
    <!-- ******************* -->
    <!-- <script type="text/javascript" src="script.js"></script> -->

</head>

<body>


    <h1 style="text-align:center">Atelier CRUD PHP</h1>
    <h1>Ajouter un article</h1>
    <form method="POST"
        action="index.php<?= ($updateArticle !== NULL)? "?updateArticle=".$updateArticle["idArticle"]: ""; ?>">
        titre:<input type="text" value="<?= ($updateArticle !== NULL)? $updateArticle["titre"]: ""; ?>" name="titre"
            placeholder="write the title here ..." id=""><br /><br />
        source:<input type="text" value="<?= ($updateArticle !== NULL)? $updateArticle["source"]: ""; ?>" name="source"
            placeholder="write the source here ..." id=""><br /><br />
        contenu:<textarea name="contenu" placeholder="write the content here ..."
            id=""><?= ($updateArticle !== NULL)? $updateArticle["contenu"]: ""; ?></textarea><br /><br />
        categorie:<input type="text" value="<?= ($updateArticle !== NULL)? $updateArticle["categorie"]: ""; ?>"
            name="categorie" placeholder="write the category here ..." id=""><br /><br />
        <input type="submit" value="<?= ($updateArticle === NULL)?'Ajouter article': 'Update article' ?>" />

    </form>
    <h1>Liste des articles</h1>
    <input type="text" name="" id="myInput" placeholder="search here..." oninput="searchFun()">
    <br>
    <br>
    <!-- *********************** -->
    <div class="outer-wrapper">
        <div class="table-wrapper">
            <table border="1" id="myTable">
                <thead>
                    <th col-index=1>id article</th>

                    <th col-index=2>titre
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all"></option>
                        </select>
                    </th>

                    <th col-index=3>source
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all"></option>
                    </th>

                    <th col-index=4>contenu
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all"></option>
                        </select>
                    </th>

                    <th col-index=5>categorie
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all"></option>
                        </select>
                    </th>

                    <th col-index=6>Actions
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all"></option>
                        </select>
                    </th>

                </thead>
                <tbody>
                    <?php
            for ($i = 0; $i < count($listArticles); $i++) {
            ?>
                    <tr>
                        <td><?= $listArticles[$i]["idArticle"]; ?></td>
                        <td><?= $listArticles[$i]["titre"]; ?></td>
                        <td><?= $listArticles[$i]["source"]; ?></td>
                        <td><?= $listArticles[$i]["contenu"]; ?></td>
                        <td><?= $listArticles[$i]["categorie"]; ?></td>
                        <td><button class="removeBtn"
                                onclick="removeArticle(<?= $listArticles[$i]['idArticle']; ?>)">Supprimer</button>
                            <button class="updateBtn"
                                onclick="updateArticle(<?= $listArticles[$i]['idArticle']; ?>)">Update</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- ***************rech -->
            <!-- <section class="container">
        <form action="" method="">
            <i class="fas fa-search"></i>
            <input type="text" name="" id="search" placeholder="search here">

        </form>

    </section> -->






            <script>
            // const searchFun = () => {
            //     let filter = document.getElementById('myInput').value.toUpperCase();
            //     let myTable = document.getElementById('myTable');
            //     let tr = myTable.getElementsByTagName('tr');
            //     for (var i = 0; i < tr.length; i++) {
            //         let td = tr[i].getElementsByTagName('td')[0];

            //         if (td) {
            //             let textvalue = td.textContent || td.innerHTML;
            //             if (textvalue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[1].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //     }
            // }




            // ***********recherche***********
            function searchFun() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }



            const removeArticle = (id) => {
                location.href =
                    `http://localhost/ateliercrudsmoh%20-%20Copie%20-%20Copie/views/index.php?removeArticle=${id}`
            }
            const updateArticle = (id) => {
                location.href =
                    `http://localhost/ateliercrudsmoh%20-%20Copie%20-%20Copie/views/index.php?updateArticle=${id}`
            }

            // ************filter***********

            window.onload = () => {
                console.log(document.querySelector("#myTable > tbody > tr:nth-child(1) > td:nth-child(2) ")
                    .innerHTML);
            };

            getUniqueValuesFromColumn()
            </script>
        </div>
    </div>
</body>

</html>