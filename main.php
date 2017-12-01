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
                <h3><a href="#">Name Surname</a></h3>
                <h4><a href="#">LOGOUT</a></h4>
            </div>
        </header>

        <nav id="menu">
                <ul>
                    <li><a href="#">My Tasks</a></li>
                    <li><a href="#">My Projects</a></li> 
                    <li><a href="#">My Collaborators</a></li> 
                    <li><a href="#">URGENT</a></li>
                    <li><a href="#">Settings</a></li>  
                </ul>
        </nav>

        <section id="main_area">
            <table>
                <tr>
                    <th>Task</th>
                    <th>Completion</th>
                    <th>Deadline</th>
                    <th>Project</th>
                </tr>
                <tr>
                    <td><a href="#">Task1</a></td>
                    <td>50%</td>
                    <td>23/12/2017</td>
                    <td><a href="#">LTW</a></td>
                </tr>
                <tr>
                    <td><a href="#">Task2</a></td>
                    <td>10%</td>
                    <td>1/1/2018</td>
                    <td><a href="#">RCOM</a></td>
                </tr>
                <tr>
                    <td><a href="#">Task3</td>
                    <td>70%</td>
                    <td>5/2/2018</td>
                    <td><a href="#">LAIG</a></td>
                </tr>
                <tr>
                    <td><a href="#">Task4</a></td>
                    <td>10%</td>
                    <td>23/3/2018</td>
                    <td><a href="#">PLOG</a></td>
                </tr>
            </table>
        </section>
        <footer>
            <p id="copyright">Copyright &copy; 2017-JLJ</p>
            <p>Task Manager</p>
       </footer>

    </body>

</html>