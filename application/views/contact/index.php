<h2 class="text-first mt-40 ml-40 mt-40">Contact Us</h2>
<div class="d-flex mr-40 ml-40 mt-24 mb-40 justify-content-between">
    <form id='contact-form'>
        <div class="form-group">          
            <div class="input-group-prepend">
                <div class="input-group-text bg-first text-white">FULL NAME</div>
            </div>
            <input class="form-control text-first" name="fullname" type="text" placeholder="Full Name">
            <div class="invalid-feedback">Please provide your full name.</div>
        </div>
        <div class="form-group">          
            <div class="input-group-prepend">
                <div class="input-group-text bg-first text-white">EMAIL</div>
            </div>
            <input class="form-control text-first" name="email" type="email" placeholder="Email">
            <div class="invalid-feedback">Please provide your email address.</div>
        </div>
        <div class="form-group">          
            <div class="input-group-prepend">
                <div class="input-group-text bg-first text-white">ROLE</div>
            </div>
            <select class="custom-select text-first" name="role">
                <option value="Unsure" selected>Unsure</option>
                <option value="Sponsor">Sponsor</option>
                <option value="Giver">Quest Giver</option>
                <option value="Adventurer">Adventurer</option>
            </select>
        </div>
        <div class="form-group">          
            <div class="input-group-prepend">
                <div class="input-group-text bg-first text-white">COMMENT</div>
            </div>
            <textarea class="form-control text-first" name="comment" cols="30" rows="10" placeholder="Enter your comments here..."></textarea>
            <div class="invalid-feedback text-danger">Please provide a comment.</div>
        </div>
        <input class="btn btn-first" type="submit" value="SUBMIT">
    </form>
</div>

<script>
    document.querySelector('#contact-form').onsubmit = function(e) {
        e.preventDefault();
        this.reset();
        window.scrollTo({
            top: 0
        })
    }
</script>