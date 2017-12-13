<?php 
    include_once('templates/common/header.php'); 
    include_once('utils/utils_general.php'); 
    if(!logged()){
        redirect('index.php');
    }
?>
<section class="main_area" id="tasks_list">
    <table>
        <tr>
            <th>Task</th>
            <th>Completion</th>
            <th>Deadline</th>
            <th class="projCol">Project</th>
        </tr>
        <tr>
            <td><a href="#">Task1</a></td>
            <td>50%</td>
            <td>23/12/2017</td>
            <td class="projCol" ><a href="#">LTW</a></td>
        </tr>
        <tr>
            <td><a href="#">Task2</a></td>
            <td>10%</td>
            <td>1/1/2018</td>
            <td class="projCol"><a href="#">RCOM</a></td>
        </tr>
        <tr>
            <td><a href="#">Task3</td>
            <td>70%</td>
            <td>5/2/2018</td>
            <td class="projCol"><a href="#">LAIG</a></td>
        </tr>
        <tr>
            <td><a href="#">Task4</a></td>
            <td>10%</td>
            <td>23/3/2018</td>
            <td class="projCol"><a href="#">PLOG</a></td>
        </tr>
    </table>
</section>
<!-- <div id="calendar_div">
    <?php 
        /* include_once('testing/calendar.php');
        echo getCalendar(); */
     ?>
</div> -->
<?php include_once('templates/common/footer.php'); ?>
