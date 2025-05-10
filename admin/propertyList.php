<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heather Dashboard</title>
    <style>

        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Inria Serif;
            overflow: hidden;
        }

        header {
            background-color: #ACDEEE;
            padding-left: 10px;
            border: 0.5px solid #333;
            font-size: 28px;
        }

        .container{
            display: flex;
            height: 100vh; /* 100% of viewport height */
        }

        nav {
            width: 300px;
            height: 100%;
            background-color: #ACDEEE;
            overflow-x: hidden;
            padding-top: 20px;
        }

        nav a {
            padding: 15px;
            text-decoration: none;
            font-size: 30px;
            color: #333;
            display: block;
        }

        nav a:hover{
            text-decoration: underline;
        }

        .content {
            /* margin-left: 220px; */
            flex: 1;
            padding: 20px;
        }

        .sidebar-image {
            padding-right: 10px;
        }

        .logout{
            margin-top: 360px;
        }

        .page-header{
            font-size: 40px;
            margin-left: 50px;
        }

        .container .content .cards{
            padding: 20px 10px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .container .content .cards .card{
            font-size: 40px;
            width: 400px;
            height: 200px;
            background: #E6E6E6;
            margin: 20px 5px;
            text-align: center;
        }

        table{
            margin-left: 50px;
        }
        table, th[scope="col"]{
            font-size: large;
            border: 1px solid #333;
            border-collapse: collapse;
            padding: 10px 50px 10px 50px;
        }
        td, th[scope="row"]{
            display: table-cell;
            padding: 15px 5px 15px 5px;
            border-right: 1px solid grey;
            text-align: center;
        }

        .button{
            padding: 5px 20px 5px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            margin: 1px;
        }
        .view-button{
            background: #0079E8;
        }
        .success-button{
            background: #07632C;
        }
        .danger-button{
            background: #C00F0F;
        }


    </style>
</head>
<body>

<header>
    <h1>Heather</h1>
</header>

<div class="container">
    <nav>
        <a href="#dashboard" onclick="redirectPage('adminDashboard')"><img class="sidebar-image" src= "../img/dashboard.png" width="35px" >Dashboard</a>
        <a href="#approvals" onclick="redirectPage('approvalList')"><img class="sidebar-image" src= "../img/form.png" width="25px" style="padding-right:15px">Approvals</a>
        <a href="#users" onclick="redirectPage('userList')"><img class="sidebar-image" src= "../img/users.png" width="25px" style="padding-right:20px">Users</a>
        <a href="#properties" onclick="redirectPage('propertyList')"><img class="sidebar-image" src= "../img/property.png" width="25px" style="padding-right:20px">Properties</a>
        <a href="#logout" class="logout" style="border-top: 0.5px solid #333" onclick="redirectPage('adminLoginPage')"><img class="sidebar-image" src= "../img/settings.png" width="25px" style="padding-right:20px">Log out</a>
    </nav>

    <div class="content">
        <p class="page-header" style="display:inline-block">Properties List</p>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Property Advertiser</th>
                <th scope="col">Property Name</th>
                <th scope="col">Property Address</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    include "../connection.php";

                    $sql = "SELECT property.PROP_ID, property.ADVERTISER_ID, CONCAT(users.USER_FNAME, ' ', users.USER_LNAME) AS user_name, property.PROP_NAME, property.PROP_ADDRESS, property.status 
                    FROM property
                    INNER JOIN users ON property.ADVERTISER_ID = users.USER_ID 
                    WHERE property.status = 'available' OR property.status = 'unavailable'";                    
                    $result = $conn->query($sql);
                    
                    if(!$result){
                        die("Invalid query!");
                    }
                    while($row=$result->fetch_assoc())
                    {
                        echo "<tr>
                                <th scope='row'>{$row['PROP_ID']}</th>
                                <td>{$row['user_name']}</td>
                                <td>{$row['PROP_NAME']}</td>
                                <td>{$row['PROP_ADDRESS']}</td>
                                <td>{$row['status']}</td>

                                <td>
                                <a class='button success-button' href='editPropertyList.php?PROP_ID={$row['PROP_ID']}'> Update status </a>
                                <a class='button view-button' href='approval/view.php?PROP_ID={$row['PROP_ID']}' onclick=> View </a>
                                <a class='button danger-button' href='deleteList.php?PROP_ID={$row['PROP_ID']}'> Delete </a>
                                </td>

                             </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../redirectPage.js"></script>

</body>
</html>
