<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-dz6cJ4jcJlf89d8OWOOyoIsP0S8t9Im7xc1fv9p6q2Cq1ObkI1gI1a3eZKL0qgP6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-vk0w/6NH9DUr7sFCaEn7GGg6O6MzQ0FuMzJ9zg3cFQUpWTkC9a6bFAKE1EtoqU2U" crossorigin="anonymous"></script>
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

    <div id="content-wrapper" class="d-flex flex-column">

        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800 text-center mt-3">Orders</h1>

            <!-- Content Centering -->
            <div class="d-flex justify-content-center align-items-center">

                <!-- Your Orders Content -->
                <div class="col-md-11">
                    <?php
                    // Your database connection code here
                    $username = "root";
                    $password = "";
                    $database = "vimin";

                    try {
                        $pdo = new PDO("mysql:host=localhost;dbname=$database", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Fetch orders with status "pending"
                        $sql = "SELECT * FROM orders";
                        $result = $pdo->query($sql);

                        if ($result->rowCount() > 0) {
                            echo '<div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Contact Number</th>
                                                <th>Delivery Option</th>
                                                <th>Total Amount</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>';

                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr data-order-id="' . $row['id'] . '" data-current-status="' . $row['status'] . '">
                                        <td>' . $row['id'] . '</td>
                                        <td>' . $row['name'] . '</td>
                                        <td>' . $row['address'] . '</td>
                                        <td>' . $row['contact_number'] . '</td>
                                        <td>' . $row['delivery_option'] . '</td>
                                        <td>' . $row['total_amount'] . '</td>
                                        <td>' . $row['status'] . '</td>
                                        <td>
                                            <select class="form-select status-dropdown">
                                                <option ' . ($row['status'] === 'Pending' ? 'selected' : '') . '>Pending</option>
                                                <option ' . ($row['status'] === 'Accepted' ? 'selected' : '') . '>Accepted</option>
                                                <option ' . ($row['status'] === 'To Ship' ? 'selected' : '') . '>To Be Shipped</option>
                                                <option ' . ($row['status'] === 'To Deliver' ? 'selected' : '') . '>To Be Delivered</option>
                                                <option ' . ($row['status'] === 'Rejected' ? 'selected' : '') . '>Rejected</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-update">Update</button>
                                        </td>
                                      </tr>';
                            }

                            echo '</tbody></table></div>';
                        } else {
                            echo '<p>No pending orders found.</p>';
                        }
                    } catch (PDOException $e) {
                        die("ERROR: Could not connect. " . $e->getMessage());
                    } finally {
                        unset($pdo);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="css/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="chart-area-demo.js"></script>
<script src="chart-pie-demo.js"></script>
<!-- Add jQuery if not already included -->

<script>
    $(document).ready(function () {
        $('.btn-update').on('click', function () {
            // Get the selected status and order ID
            var selectedStatus = $(this).closest('tr').find('.status-dropdown').val();
            var orderId = $(this).closest('tr').data('order-id');

            // Perform an asynchronous request to update the status
            $.ajax({
                type: 'POST',
                url: 'update_status.php', // Specify the correct URL for your update script
                data: { orderId: orderId, status: selectedStatus },
                success: function (response) {
                    // Update the status on the page
                    $(this).closest('tr').find('td:nth-child(6)').text(selectedStatus);
                    // Optionally, you can display a success message or handle other UI changes
                    console.log('Status updated successfully.');

                    location.reload();
                },
                error: function () {
                    console.error('Error updating status.');
                }
            });
        });
    });
</script>




</body>
</html>