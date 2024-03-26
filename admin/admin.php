<?php
include 'config.php';
session_start();

//

// Fetch the total amount sum from the orders table
$sql = "SELECT SUM(total_amount) AS totalSum, SUM(JSON_UNQUOTE(JSON_EXTRACT(cart_data, '$[*].quantity'))) AS totalQuantity FROM orders";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $totalSum = $row['totalSum'];
    $totalQuantity = $row['totalQuantity'];
} else {
    $totalSum = 0; // Default value if the query fails
    $totalQuantity = 0; // Default value if the query fails
}

// retrieve total number of names in orders table
$sql = "SELECT COUNT(*) as totalNames FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalNames = $row["totalNames"];
} else {
    $totalNames = 0;
}


// Fetch the count of orders with status "Pending"
$sqlPending = "SELECT COUNT(*) as totalPending FROM orders WHERE status = 'Pending'";
$resultPending = $conn->query($sqlPending);

if ($resultPending->num_rows > 0) {
    $rowPending = $resultPending->fetch_assoc();
    $totalPending = $rowPending["totalPending"];
} else {
    $totalPending = 0;
}

// retrieve the total number of users
$sql = "SELECT COUNT(*) as totalUsers FROM registration";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalUsers = $row["totalUsers"];
} else {
    $totalUsers = 0;
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-dz6cJ4jcJlf89d8OWOOyoIsP0S8t9Im7xc1fv9p6q2Cq1ObkI1gI1a3eZKL0qgP6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <title>Admin Panel</title>
</head>







<body id="page-top">


  


<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-light sidebar sidebar-light accordion" id="accordionSidebar navigationStyle">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon ">
                <img src="img/pic3.png" alt="" width="40px" height="40px">
            </div>
            <div class="sidebar-brand-text mx-3 text-dark">VIMIN</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="admin.php" 
                >
                <i class="fa-solid fa-house" style="color:#000000;"></i>
                <span class="text-dark">Dashboard</span>
            </a>
          
        </li>
    
        


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="products.php" 
                >
                <i class="fa-solid fa-cart-shopping" style="color:#000000;"></i>
                <span class="text-dark">Products</span>
            </a>
          
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="orders.php" 
                >
                <i class="fas fa-clipboard-list" style="color:#000000;"></i>
                <span class="text-dark">Orders</span>
            </a>
          
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        

        
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle ">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>



                    <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
        <img class="img-profile rounded-circle mr-5" src="img/rj45.png" id="adminImage">
    </a>

</li>



                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">


                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Revenue</div>
                                        <?php
                                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800">₱' . number_format($totalSum, 2) . '</div>';
                                        ?>

                                        </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Orders</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalNames; ?></div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-1">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Customers
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 ml-3"><?php echo $totalUsers; ?></div>
                                            </div>
                                          
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalPending ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <div class="container-fluid">
        <div class="row">
                <div class="graphBox">
                    <canvas id="earnings"></canvas>           
                </div> 
               
                <script>
    // Fetch data from the server using PHP and include it in the script
    const fetchData = async () => {
        try {
            const response = await fetch('mostItemsData.php');
            const data = await response.json();

            if (data.error) {
                throw new Error(data.error);
            }

            // Update the labels array with the product names from the database
            config.data.labels = data.labels;
            // Update the data array with the actual stocks values
            config.data.datasets[0].data = data.values;

            // Assign different colors to each bar
            const backgroundColors = [
                'blue',
                'green',
                'red',
                'black',
                'purple',
                'yellow',
            ];

            // Assign border colors for the bars
            const borderColors = backgroundColors.map(color => color.replace('0.2', '1'));

            config.data.datasets[0].backgroundColor = backgroundColors;
            config.data.datasets[0].borderColor = borderColors;

            // Create the bar chart with updated data
            const earnings = new Chart(
                document.getElementById('earnings'),
                config
            );
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    // Your initial chart configuration
    const config = {
        type: 'bar',
        data: {
            labels: [], // Will be populated with product names from the database
            datasets: [{
                label: 'Product Stocks',
                data: [], // Will be populated with actual stocks values
                backgroundColor: [],
                borderColor: [],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Call the fetchData function to fetch data and update the chart
    fetchData();
</script>
                </div>
        </div>

         <!-- Content Row -->
               

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../showcase.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-dz6cJ4jcJlf89d8OWOOyoIsP0S8t9Im7xc1fv9p6q2Cq1ObkI1gI1a3eZKL0qgP6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<!-- Bootstrap core JavaScript-->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.umd.min.js"></script>
<!-- Your other script tags -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- ... (your existing HTML code) ... -->

<!-- JavaScript to show/hide the logout popup and display confirmation message -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the admin image, logout link, and logout modal elements
        var adminImage = document.getElementById('adminImage');
        var logoutLink = document.getElementById('logoutLink');
        var logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));

        // Add click event listener to the admin image
        adminImage.addEventListener('click', function (event) {
            // Show the logout modal when the admin image is clicked
            logoutModal.show();
        });

        // Add click event listener to the logout link to display the confirmation message
        logoutLink.addEventListener('click', function (event) {
            // You can display a confirmation message here if needed
            console.log('Logout link clicked!');
        });
    });
</script>

<!-- ... (your existing HTML code) ... -->


<script src="customJS.js"></script>








<!-- JavaScript to show/hide the logout popup and display confirmation message -->

</body>
</html>