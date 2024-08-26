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
            <li class="breadcrumb-item active">View Incoming</li>
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
            return `
              <button class="send-btn" onclick="receiveMemo(${row.memo_id})">Receive</button>
              <button class="forward-btn" onclick="forwardMemo(${row.memo_id}, '${row.To_Department}')">Forward</button>`;
          }
        },
      ]
    });
  });

  function receiveMemo(memoId) {
    // Your send memo function logic here
    const userEmail = "<?php echo $_SESSION['user']['email']; ?>"; // Assuming user email is stored in session
    const status = "Received";
    const dateReceived = new Date().toISOString().slice(0, 19).replace('T', ' ');


    alert('Receive memo with ID: ' + memoId);
    // You can add AJAX call or any other logic here
    $.ajax({
      url: 'receive_memo.php',
      type: 'POST',
      data: {
        memo_id: memoId,
        user_email: userEmail,
        status: status,
        date_received: dateReceived
      },
      success: function(response) {
        alert(response); // Display response from PHP script
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  }

  function forwardMemo(memoId) {
    // Fetch the list of departments
    alert('Forward memo with ID: ' + memoId);
    $.ajax({
      url: 'get_dept.php',
      type: 'POST',
      success: function(response) {
        // Create and display the department dropdown
        const departmentSelect = `<select id="departmentSelect">${response}</select>`;
        const departmentDialog = `
                <div id="departmentDialog" style="border: 1px solid #ccc; padding: 20px; background: #fff; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                    <label for="departmentSelect">Choose a department to forward the memo:</label>
                    ${departmentSelect}
                    <button onclick="confirmForward(${memoId})">Forward</button>
                    <button onclick="$('#departmentDialog').remove();">Cancel</button>
                </div>`;
        $('body').append(departmentDialog);
      },
      error: function(xhr, status, error) {
        console.error('Error fetching departments:', error);
      }
    });
  }

  function confirmForward(memoId) {
    const selectedDeptId = $('#departmentSelect').val();

    if (!selectedDeptId) {
      alert('Please select a department to forward the memo.');
      return;
    }

    // AJAX request to forward the memo
    // alert('Forward memo with ID: ' + memoId);
    alert('Forward memo with ID: ' + memoId + ' to department ID: ' + selectedDeptId);
    $.ajax({
      url: 'forward_memo.php', // Change this to the appropriate PHP file that handles forwarding
      type: 'POST',
      data: {
        memo_id: memoId,
        dept_id: selectedDeptId
      },
      success: function(response) {
        console.log('Response from server:', response); // Log the response to see its structure
        if (response) {
          alert('Memo forwarded successfully!');
        } else {
          alert( response);
        }
        // Remove the dialog
        $('#departmentDialog').remove();
      },
      
      error: function(xhr, status, error) {
        console.error('Error forwarding memo:', error);
        console.error('XHR:', xhr); // Log the full XHR object for more details
        alert('An error occurred while forwarding the memo.');
      },
    });
  }
</script>

<?php include 'layout/footer.php'; ?>