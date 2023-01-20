<?php
session_start();
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $actname = $_POST['actname'];
    $dept = $_POST['dept'];
    $doevent = $_POST['doevent'];
    $doentry = $_POST['doentry'];
    $noa = $_POST['noa'];
    $email = $_POST['email'];
  
    $sql = "INSERT INTO `form` (`actname`, `dept`, `doevent`, `doentry`, `noa`, `email`, `created_at`) VALUES ('$actname', '$dept', '$doevent', '$doentry', '$noa', '$email', current_timestamp());";
    // echo $sql;

    if($conn->query($sql) == true){
        // echo "Successfully inserted";
    }
    else{
      echo "Error: $sql <br> $conn->error";
    }
  }

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="Colorlib Templates" />
    <meta name="author" content="Colorlib" />
    <meta name="keywords" content="Colorlib Templates" />

    <title>Activity Portal</title>

    <link
      href="vendor/mdi-font/css/material-design-iconic-font.min.css"
      rel="stylesheet"
      media="all"
    />
    <link
      href="vendor/font-awesome-4.7/css/font-awesome.min.css"
      rel="stylesheet"
      media="all"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
    <link
      href="vendor/datepicker/daterangepicker.css"
      rel="stylesheet"
      media="all"
    />

    <link href="css/main.css" rel="stylesheet" media="all" />
  </head>

  <body>
    <div class="navbar">
    <form name="form1" method="post" action="logout.php">
        <button>
          <label class="logout">
          <input
            class="btnlog" name="submit2" type="submit" id="submit2" value="Logout"/>
          </label>
        </button>
      </form>
    </div>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
      <div class="wrapper wrapper--w680">
        <div class="card card-4">
          <div class="card-body">
            <h2 class="title">Activity Portal</h2>

          <form name="form1" method="post" action="welcome.php">
              <div class="row row-space">
                <div class="col-2">
                  <div class="input-group">
                    <label class="label" name="actname" id="actname">Activity Name</label>
                    <input
                      class="input--style-4"
                      type="text"
                      name="actname"
                    />
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group">
                    <label class="label" name="dept" id="dept">Organizing Person/Department</label>
                    <input
                      class="input--style-4"
                      type="text"
                      name="dept"
                    />
                  </div>
                </div>
              </div>
              <div class="row row-space">
                <div class="col-2">
                  <div class="input-group">
                    <label class="label" name="doevent" id="doevent">Date of Event</label>
                    <div class="input-group-icon">
                      <input
                        class="input--style-4 js-datepicker"
                        type="text"
                        name="doevent"
                      />
                      <i
                        class="zmdi zmdi-calendar-note input-icon js-btn-calendar"
                      ></i>
                    </div>
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group">
                    <label class="label" name="doentry" id="doentry">Date of Entry</label>
                    <div class="input-group-icon">
                      <input
                        class="input--style-4 js-datepicker"
                        type="text"
                        name="doentry"
                      />
                      <i
                        class="zmdi zmdi-calendar-note input-icon js-btn-calendar"
                      ></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row row-space">
                <div class="col-2">
                  <div class="input-group">
                    <label class="label" name="noa" id="noa">Number Of Attendees</label>
                    <input
                      class="input--style-4"
                      type="text"
                      name="noa"
                    />
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group">
                    <label class="label" name="email" id="email">Email</label>
                    <input class="input--style-4" type="email" name="email" />
                  </div>
                </div>
              </div>

              <div class="p-t-15">
                <button class="btn btn--radius-2 btn--blue" type="submit">
                  Submit
                </button>
              </div>
            </form>
            <form action="export.php" method="post">					
				    <button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn--radius-2 btn--blue export">Export to excel</button>
			      </form>
      
          </div>
        </div>
      </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <script src="./JavaScript/global.js"></script>
  </body>
</html>

