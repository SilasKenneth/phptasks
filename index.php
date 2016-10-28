<?php 
abstract class Database{
    public static function connect(){
        $config=self::getIniConfig();
         if($config==false){
             echo "<p class='card row red white-text' style='top:0;left:0;'> Sorry there is a problem with our system for now</p>";
         }else{
             try{
                 $conn=new PDO($config['dsn'],$config['anon'],$config["passiwadi"]);
                   return $conn;
             }catch(PDOException $ex){
                 echo $ex->getMessage();
             }
         }
    }
    private static function getIniConfig(){
      $ini=parse_ini_file(".vars",true);
      if(!$ini){
          return false;
      }else{
        $settings=$ini['mysql'];
        return $settings;
      }
    }
    function echoOut(){
        return self::connect();
    }
}
class Requirement extends Database{
    public static function getRequirements(){
        $sql="SELECT * FROM requirements";
       $qr=parent::connect()->prepare($sql);
       $qr->execute();
       $records=$qr->fetchAll(PDO::FETCH_ASSOC);
       if(count($records)>0){
       for($i=0;$i<count($records);$i++){
           $reqs= ' 
                            <div class="collection-item avatar">
                                <img class="circle" src="./bg.jpg"></img>
                                
                                <h2 class="title green-text">'.$records[$i]["name"].'</h2>
                                <div class="divider"></div>
                                <br>
                                 <div class="separator"></div>
                                  <div class="separator"></div>
                                <p class="grey-text darken-9" style="font-weight:300;font-style:italic;">'.$records[$i]["projectrole"].'<div class="secondary-content">
                                    
                                   <a href="#" class="" title="View requirement"><i class="material-icons">info</i></a>';
                                   
                                    if($records[$i]['status']==0){
                                        /* 
                                    
                                        Allow only requirements which have not been met to be marked done


                                        */
                                        $reqs .='<a href="#" class="" title="Mark met"><i class="material-icons green-text">done</i></a>';
                                    }else {
                                        /* If a requirement was marked met by mistake or was confused this is used to review your flag and mark it unmet */ 
                                       $reqs .='<a href="#" class="" title="Mark required again(was met but not met now)"><i class="material-icons orange-text">replay</i></a>';
                                    }
                                    $reqs .='
                                    
                                    <a href="#" class="" title="Delete this requirement"><i class="material-icons red-text">delete</i></a>
                                </div>      
           </div>
           
           
           
           

           ';
           echo $reqs;
       }
       }
    }
    public static function addRequirement(){
      
    }
    public static function deleteRequirement($requirementid){
      $sql="DELETE * FROM requirements WHERE id=?";
      $qr=parent::connect()->prepare();
      $qr->execute();
    }
    public static function markSatisfied($requirementId){

    }
}
class Task extends Database{
    public static function getTasks(){
           $sql="SELECT * FROM tasks";
       $qr=parent::connect()->prepare($sql);
       $qr->execute();
       $records=$qr->fetchAll(PDO::FETCH_ASSOC);
       if(count($records)>0){
           
       for($i=0;$i<count($records);$i++){

           $tasks= ' 
                            <div class="collection-item avatar">
                                <img class="circle" src="./bg.jpg"></img>
                                
                                <h2 class="title green-text">'.$records[$i]["tasktitle"].'</h2>
                                <div class="divider"></div>
                                <p class="grey-text darken-9" style="font-weight:300;font-style:italic;">';
                                $paragraph = $records[$i]['begindate'];
$date = DateTime::createFromFormat('Y-m-d', $paragraph);
$correct =$date->format('dS F Y');
                                $tasks .='<strong style="font-style:normal;">Created on: </strong>'.$correct
                                .
                                '</p>';
                                $tasks .='<p class="grey-text darken-9" style="font-weight:300;font-style:italic;">';
                                $paragraph = $records[$i]['endson'];
$date = DateTime::createFromFormat('Y-m-d', $paragraph);
$correct =$date->format('dS F Y');
                                $tasks .='<strong style="font-style:normal;">Ends on: </strong>'.$correct
                                .
                                '</p>';
                                if($records[$i]['endedon'] !='0000-00-00'){
                                   $tasks .='<p class="grey-text darken-9" style="font-weight:300;font-style:italic;">';
                                $paragraph = $records[$i]['endedon'];
$date = DateTime::createFromFormat('Y-m-d', $paragraph);
$correct =$date->format('dS F Y');
$tasks .='<strong style="font-style:normal;">Date Completed: </strong>'.$correct
                                .
                                '</p>';
                                }
                                
                                
                               
                               /* Use in the Task view
                                $notes=explode(",",$records[$i]['tasknotes']);
                                
                            
                                
                                
                                $tasks .="<ol class='collection'>";
                                if(count($notes)>= 2){
                                for($j=0;$j<2;$j++){
                                   $tasks .='<li class="collection-item" style="font-weight:400;">'.$notes[$j].'</li>';
                                
                                }
                                }elseif(count($notes)<2){
                                     $tasks .='<li class="collection-item" style="font-weight:400;">'.$notes[0].'</li>';
                                }
                               
                                if(count($notes) > 2){
                                    for($k=0;$k<3;$k++){
                                   $tasks .='<li class="collection-item" style="font-weight:400;">'.$notes[$k].'</li>';
                                
                                }
                                
                                     $tasks .="<a href='#!'>View more</a>";
                                }
                                 $tasks .='</ol>';
                                 */

                                
                                

                                
                                $tasks .='<div class="secondary-content">
                                    
                                   <a href="#" class="" title="View requirement"><i class="material-icons">info</i></a>';
                                   
                                    if($records[$i]['endedon']=='0000-00-00'){
                                        /* 
                                    
                                        Allow only requirements which have not been met to be marked done


                                        */
                                        $tasks .='<a href="#" class="" title="Mark done"><i class="material-icons green-text">done</i></a>';
                                    }else {
                                        /* If a requirement was marked met by mistake or was confused this is used to review your flag and mark it unmet */ 
                                       $tasks .='<a href="#" class="" title="Mark redo again(was met but not met now)"><i class="material-icons orange-text">replay</i></a>';
                                    }
                                    $tasks .='
                                    
                                    <a href="#" class="" title="Delete this requirement"><i class="material-icons red-text">delete</i></a>
                                </div>      
           </div>
           
           
           
           

           ';
           echo $tasks;
       }
       }
    }
    public static function getByTaskId($taskId){

    }
}
class Progress extends Database{
    public static function getTaskProgress($taskid){
        $taskid=Task::getByTaskId($taskid);
        $sql="SELECT tasks.tasktitle,tasks.progess FROM tasks WHERE tasks.taskid=?";
        $qr=parent::connect()->prepare($sql);
        $qr->bindParam(1,$taskid);
    }
    public static function getGeneralTasksProgress(){
        
        $sql="SELECT avg(tasks.progress) FROM tasks";
        $qr=parent::connect()->prepare($sql);
        $qr->execute();
        $progressed=$qr->fetch();
        return number_format($progressed[0],0);
    
    }
    public static function getRequirementsProgress(){
        $sqlcompleted="SELECT count(requirements.id) AS completed FROM requirements WHERE requirements.status = ? ";
        $status=1;
        $sqltotal="SELECT count(*) AS totals FROM requirements";
        $query=parent::connect()->prepare($sqlcompleted);
        $query1=parent::connect()->prepare($sqltotal);
        $query->bindParam(1,$status);
        $query->execute();
        $query1->execute();
        $completed=$query->fetchAll();
        $total=$query1->fetchAll();
        $percent=(($completed[0][0] / $total[0][0]) * 100);
       return $percent;
        
    }
}

?>
<!DOCTYPE html>
  <head>
      <link rel="stylesheet" href="css/materialize.css">
      <link rel="stylesheet" href="css/material-icons.css">
      <link rel="stylesheet" type="text/css" href="css/app.css">
       <title>Andela Tasks Manager</title>
  </head>
  <body class="teal lighten-2">
  <div>
    <div class="carousel carousel-slider center" data-indicators="true">
    
    <div class="carousel-item  white-text center" style="background:url('https://static.pexels.com/photos/9056/pexels-photo.jpg');background-size:cover;" href="#one!">
   
      <h2>First Panel</h2>
      <p class="white-text">This is your first panel</p>
      <a href="#!" class="btn waves-effect waves-light grey lighten-3 grey-text">Yellow </a>
    </div>
    <div class="carousel-item amber white-text center" href="#two!">
      <h2>Second Panel</h2>
      <p class="white-text">This is your second panel</p>
    </div>
    <div class="carousel-item green white-text center" href="#three!">
      <h2>Third Panel</h2>
      <p class="white-text">This is your third panel</p>
    </div>
    <div class="carousel-item blue white-text center" href="#four!">
      <h2>Fourth Panel</h2>
      <p class="white-text">This is your fourth panel</p>
    </div>
  </div>
  </div>

  <!-- End corousal -->
      <div class="row section grey lighten-4 ">
      
          <h1 class="heading center " style="font-family:Lato;font-weight:100;">
                  Presentation in the wild
              </h1>
              <p class="red-text" style="font-weight:300;font-style:italic;text-align:center;">This is a project geared towards the achievemnent of the Project which could entail the following
             </p><div class="divider"></div>
             <div class="clearfix"></div>
             <!-- Chips -->
             <p class="chip col m8 s12 l4">
             <img src="bg.jpg" alt="">
             Realtime presentation of work done with sound
             <i class="material-icons close">close</i>

             </p>

             <p class="chip">
             <img src="bg.jpg" alt="">
              Teaching of students through examples from your window to all the people in the chatroom
             <i class="material-icons close">close</i>

             </p>

             <p class="chip">
             <img src="bg.jpg" alt="">
               Sharing of screenshots online
             <i class="material-icons close">close</i>

             </p>
             <!-- END CHIPS -->
      </div>
      <!-- Add requirement modal -->
      <div class="row section">
         <div class="col s12 m12 l6">
             <div class="card  grey lighten-4">
                   <div class="card-content">
                   <div >
                      <a href="#addRequirement" class="btn btn-large btn-floating waves-effect modal-trigger right green addRequirement" data-activates="addRequirement" title="Add new requirement"><i class="material-icons">add</i></a>
                      <div class="clearfix"></div>
                      <div id="addRequirement" class="modal">
                      <form action="" method="POST">
                        
                         <div class="modal-content">
                         <div class="row  style="font-weight:700;"">
                            <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix green-text">chat</i>
                             <input type="text"  name="requirementname" id="requirementname">
                             <label for="requirementname">Requirement name</label>
                            </div>
                            <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix green-text">group_work</i>
                             <input type="text"  name="projectrole" id="projectrole">
                             <label for="projectrole">Role in Project</label>
                            </div>
                            <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix green-text">label</i>
                             <input type="text"  name="requirementname" id="dependencies">
                             <label for="dependencies">Dependencies (Separated by commas)</label>
                            </div>
                            <div class="input-field col s12 m12 l6">
                            <i class="material-icons prefix green-text">receipt</i>
                             <select name="status" >
                                <option value="" disabled selected>Requirement status</option>
                                <option value="1" class="green">Met</option>
                                <option value="0">Not met</option>
                             </select>
                             
                            </div>
                        </div>
                         </div>
                         <div class="modal-footer">
                           <button type="submit" class="right btn btn-medium blue">Save requirement</button>
                         </div>
                         </form>
                      </div>
                   </div>
                      <h4 class="blue-text center">Requirements</h4>
                        <div class="collection">                     
                                <?php Requirement::getRequirements(); ?>
                            
                        </div>
                   </div>
             </div>
         </div>
          
         
<!-- Work Plan -->
         <div class="col s12 m12 l6">
             <div class="card  grey lighten-4">
                   <div class="card-content">
                   <a href="#!" class="grey btn btn-floating btn-large right lighten-3"><i class="material-icons grey-text">add</i></a>
                   <div class="clearfix"></div>
                  
                   <h1 class="center blue-text">Tasks</h1>
                      <div class="collection">
                         
                            <?php
                             Task::getTasks();
                             //"prints" 2014 January
                             ?>
                         
                      </div>
                   </div>

             </div>
         </div>
         <div class="col s12 m12 l6">
         
             <div class="card grey lighten-4">
             
                   <div class="card-content">
                   <a href="#!" class="grey btn btn-floating btn-large right lighten-3"><i class="material-icons grey-text">add</i></a>
                   <div class="clearfix"></div>
                  
                   <h1 class="center blue-text">Progress</h1>
                      <div class="collection">
                         <h6>Requirements progress</h6>
                         <div class="collection-item avatar">
                              <div class="collection">
                                   <div class="collection-item avatar">
                                   <img src="bg.jpg" class="circle" alt="">
                                    <h4>Progress</h4>
                                      <div class="progress">
                                       <div class="determinate" style="width:<?= Progress::getRequirementsProgress().'%'; ?>" ></div>
                                      </div><span class="red-text right" style="font-weight:600px;font-size:45px;"><?= Progress::getRequirementsProgress().'%'; ?></span>
                                   <div class="clearfix"></div>
                                   </div>
                              </div>

                         </div>
                         <h6>Task progress</h6>
                         <div class="collection-item avatar">
                              <div class="collecction">
                                   <div class="collection-item avatar">
                                   <img src="bg.jpg" class="circle" alt="">
                                      <h3 class="title">
                                         Gettting things in place

                                    </h3>
                                   <div class="divider">

                                   </div>
                                      <div class="progress">
                                       <div class="determinate" style="width: 20%" ></div>
                                      </div>
                                   </div>
                                   <div class="collection-item avatar">
                                   <img src="bg.jpg" class="circle" alt="">
                                    <h3 class="title">
                                         Gettting things in place

                                    </h3>
                                   <div class="divider">

                                   </div>
                                      <div class="progress">
                                       <div class="determinate" style="width: 100%" ></div>
                                      </div>
                                   </div>
                                   <div class="collection-item avatar">
                                   <img src="bg.jpg" class="circle" alt="">
                                      <h3 class="title">
                                        Blender support

                                    </h3>
                                   <div class="divider">

                                   </div>
                                      <div class="progress grey lighten-2">
                                       <div class="determinate" style="width: 10%" ></div>
                                      </div>
                                   </div>
                                   <div class="collection-item avatar">
                                   <img src="bg.jpg" class="circle" alt="">
                                      <h3 class="title">
                                         Gettting things in place

                                    </h3>
                                   <div class="divider">

                                   </div>
                                      <div class="progress">
                                       <div class="determinate" style="width: 70%" ></div>
                                      </div>
                                      
                                   </div>
                                  
                              </div>
                              <!-- General Progress -->
                               <div class="clearfix"></div>
                               <br><br>
                            <div class="collection-item avatar">
                            <div class="divider"></div>
                                   <h5>General task progress: </h5>
                                      <div class="clearfix"></div>
                                      <div class="progress">
                                       <div class="determinate" style="width:<?= Progress::getGeneralTasksProgress().'%'; ?>" > </div>
                                      </div>
                                      <span class="red-text right" style="font-weight:600px;font-size:45px;"><?= Progress::getGeneralTasksProgress().'%'; ?></span>
                               <br>
                         
                      </div>
                   </div>

             </div>
         </div>
                  
       </div>
   <script src=""></script>
   <script>
    $(function(){
      $(document).ready(function(){
          $(".addRequirement").leanModal();
          $('select').material_select();
          $(".carousel.carousel-slider").carousel({full_width:true,indicators:true,time_constant:70});
 
autoplay();  
function autoplay() {
    $('.carousel.carousel-slider').carousel('next');
    setTimeout(autoplay, 4500);
}
      });
    });
   </script>
  </body>
</html>
