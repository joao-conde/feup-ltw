<!DOCTYPE html>

<html lang="en-US"> 
    <head>
        <script src="https://use.fontawesome.com/8518b8a976.js"></script>
        <title>Task Manager</title>
        <meta charset="UTF-8">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <header id="header_top">
            <div id="logo"> 
                <h1><img src="images/logo.svg"><a href="#">Task Manager</a></h1>
                <h2>Manage your time</h2>
            </div>
            <img src="images/feuplogo.jpeg"/>
            <div id="profile">
                <h3><a href="#">PROJECT Name Surname</a></h3>
                <h4><a href="#">LOGOUT</a></h4>
            </div>
        </header>
        
        <nav id="menu">
                <ul>
                    <li><a href="main.php">My Tasks</a></li>
                    <li><a href="projects_view.php">My Projects</a></li> 
                    <li><a href="#">My Collaborators</a></li> 
                    <li><a href="#">URGENT</a></li>
                    <li><a href="#">Settings</a></li>  
                </ul>
        </nav>

        <section id="main_area">
            <table>
                <tr>
                    <th>Project</th>
                    <th>Owner</th>
                    <th>Collaborators</th>
                </tr>
                <tr>
                    <td><a href="#">P1</a></td>
                    <td>USER1</td>
                    <td>lista de colabs?</td>
                </tr>
                <tr>
                    <td><a href="#">P2</a></td>
                    <td>USER2</td>
                    <td>lista de colabs?</td>
                </tr>
                <tr>
                    <td><a href="#">P3</td>
                    <td>USER3</td>
                    <td>lista de colabs?</td>
                </tr>
                <tr>
                    <td><a href="#">P4</a></td>
                    <td>USER4</td>
                    <td>lista de colabs?</td>
                </tr>
            </table>
        </section>
        <footer>
            <p id="copyright">Copyright &copy; 2017-JLJ</p>
            <p>Task Manager</p>
       </footer>

    </body>

</html>