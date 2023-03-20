<!-- Button trigger modal -->
<!--
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">
  Sign Up
</button>
-->

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupModalLabel">Enter the Sign Up Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <!-- Sign Up Form -->
        <form method="POST" action="/login-dir/php-forum/partials/_handleSignup.php">

          <div class="mb-3">
            <label for="signupEmail" class="form-label">Username</label>
            <input type="text" class="form-control" id="signupEmail" name="signupEmail" placeholder="">
          </div>
          <div class="mb-3">
            <label for="signupPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="signupPassword" name="signupPassword">
          </div>
          <div class="mb-3">
            <label for="signupCpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="signupCpassword" name="signupCpassword">
          </div>
          <button type="submit" class="btn btn-primary">Sign Up</button>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>