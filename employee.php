<?php require_once "session.php" ?>



<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Prime Mover Management System</title>

    <meta name="description" content="" />

   <?php require_once "includes/css.php"; ?>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
       <?php include_once 'includes/menu.php' ?>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

         <?php include_once 'includes/navbar.php' ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              
           <!-- add employee button here -->
            <div class="card-body">
                     <!-- Button trigger modal -->
                      <div class="demo-inline-spacing">
                        <button type="button" class="btn rounded-pill btn-outline-primary"  data-bs-toggle="modal"
                          data-bs-target="#employeeAddModal">Add Employee</button>
                      </div>
                    </div>

                  <!-- Vertically Centered Modal -->
                  <div class="col-lg-4 col-md-6">
                      
                      <div class="mt-3">

                        <!-- Modal -->
                        <div class="modal fade" id="employeeAddModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="employeeAddModalTitle">Add Employees</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Full Name</label>
                                    <input
                                      type="text"
                                      id="nameWithTitle"
                                      class="form-control"
                                      placeholder="Enter Name"
                                    />
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">Email</label>
                                    <input
                                      type="text"
                                      id="emailWithTitle"
                                      class="form-control"
                                      placeholder="xxxx@xxx.xx"
                                    />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobWithTitle" class="form-label">DOB</label>
                                    <input
                                      type="text"
                                      id="dobWithTitle"
                                      class="form-control"
                                      placeholder="DD / MM / YY"
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php include "includes/footnav.php"; ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
<?php require_once 'includes/js.php'; ?>
  </body>
</html>
