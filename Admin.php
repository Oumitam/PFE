
<?php require("connexion.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Employees</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Employee List</h1>
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Status</th>
            <th>Project</th>
        </tr>

        <?php
        $sql = "SELECT e.img, e.nom, e.prenom, e.statut, e.Idpjt, p.nompjt  AS project_name FROM utilisateurs e LEFT JOIN projets p ON e.Idpjt = p.Idpjt";
        $result = $cnx->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='" . $row['img'] . "' alt='" . $row['prenom'] .  $row['nom'] ."'></td>";
                echo "<td>" . $row['nom'] . "</td>";
                echo "<td>" . $row['statut'] . "</td>";
                if ($row['statut'] == 'working') {
                    echo "<td><a href='detail.php?Idpjt=" . $row['Idpjt'] . "'>" . $row['nompjt'] . "</a></td>";
                } else {
                    echo "<td>" . $row['nompjt'] . "</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employees found</td></tr>";
        }


        ?>

    </table>
</body>
</html>

