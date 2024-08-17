<?php

include 'layout/header.php';
// var_dump($_SESSION['user']);
?>
<?php
// include('includes/header.php');
include('includes/sidebar.php');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">User Dashboard</h1> -->
          <h1 class="text-light m-0">Welcome, Secretary <?php echo $_SESSION['user']['first_name']; ?> <?php echo $_SESSION['user']['dept_id']; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">View Outgoing</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- /.content-header -->
    <!-- Content Wrapper. Contains page content -->
  </div>



  <table id="memosTable" class="display" style="width:100%">
    <thead>
      <tr>
        <th>Memo ID</th>
        <th>Subject</th>
        <th>Author</th>
        <th>To Department</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>

</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    $('#memosTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "view-pro.php", // Path to PHP script
        "type": "POST"
      },
      "columns": [{
          "data": "memo_id"
        },
        {
          "data": "subject"
        },
        {
          "data": "Author"
        },
        {
          "data": "To_Department"
        },
        {
          "data": "Status"
        },
        {
          "data": "date_created"
        },
        {
          "data": null,
          "render": function(data, type, row) {
            return `<button class="send-btn" onclick="sendMemo(${row.memo_id})">Send</button>`;
          }
        }
      ]
    });
  });
 
  function sendMemo(memoId) {
    // Your send memo function logic here

    alert('Send memo with ID: ' + memoId);
    // You can add AJAX call or any other logic here
  }

  function sendMemo(memoId) {
    alert('Send memo with ID: ' + memoId);
    $.ajax({
      url: 'send_memo.php',
      type: 'POST',
      data: {
        memo_id: memoId
      },
      success: function(response) {
        alert(response); // Display response from PHP function
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  }
</script>


<?php include 'layout/footer.php'; ?>