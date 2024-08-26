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
            <li class="breadcrumb-item active">Audit Trail</li>
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

  <!-- Button to trigger the audit trail display -->
<button id="viewAuditTrailBtn" data-memo-id="1">View Audit Trail</button>

<!-- Modal to display the audit trail -->
<div id="auditTrailModal" style="display:none;">
    <table id="auditTrailTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Action Type</th>
                <th>Action Date</th>
                <th>User Email</th>
            </tr>
        </thead>
    </table>
</div>

</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    $('#memosTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "outgoing-pro.php", // Path to PHP script that fetches memos
        "type": "POST"
      },
      "columns": [
        { "data": "memo_id" },
        { "data": "subject" },
        { "data": "Author" },
        { "data": "To_Department" },
        { "data": "Status" },
        { "data": "date_created" },
        {
          "data": null,
          "render": function(data, type, row) {
            return `<button class="view-audit-log-btn" onclick="viewAuditLog(${row.memo_id})">View Audit Log</button>`;
          }
        }
      ]
    });
  });

  function viewAuditLog(memoId) {
    // Perform an AJAX request to fetch and display the audit log for the memo
    $.ajax({
      url: 'audit_trail.php', // Path to your PHP script that fetches the audit trail
      type: 'POST',
      data: {
        memo_id: memoId
      },
      success: function(response) {
        // Assuming the response is a JSON array of audit logs
        console.log('Response from server:', response); 
        alert('memo info with ID for:'+ memoId + response);
        var auditLogData = JSON.parse(response);

        // Display audit log data (you could display this in a modal or on the page)
        var auditLogHtml = '<ul>';
        auditLogData.forEach(function(log) {
          auditLogHtml += '<li>' + 
                            'Action Type: ' + log.action_type + ', ' + 
                            'Action Date: ' + log.action_date + ', ' + 
                            'User Email: ' + log.user_email + 
                          '</li>';
        });
        auditLogHtml += '</ul>';

        // Show the audit log in a modal
        $('#auditTrailModal .modal-body').html(auditLogHtml);
        $('#auditTrailModal').show(); // Show the modal
      },
      error: function(xhr, status, error) {
        console.error('Error fetching audit log:', error);
      }
    });
  }
</script>


<!-- <script>
  document.addEventListener('DOMContentLoaded', () => {
    $('#auditTrailTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "outgoing-pro.php", // Path to PHP script
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
            return `<button class="send-btn" onclick="sendMemo(${row.memo_id})">View Log</button>`;
          }
        }
      ]
    });
  });
 
  function sendMemo(memoId) {
    // Your send memo function logic here
    // console.log('Response from server:', response); 

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
</script> -->


<?php include 'layout/footer.php'; ?>