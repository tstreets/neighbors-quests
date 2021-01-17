<h2 class="text-first mt-40 ml-40 mr-40">New Quest</h2>
<form class="newquestform ml-40 mr-40 mb-40">
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" type="text" name="name">
    </div>

    <div class="form-group">
        <label>Photo</label>
        <input class="form-control" type="file" name="image">
    </div>

    <div class="form-group">
        <label>Details</label>
        <textarea class="form-control" type="text" name="details"></textarea>
    </div>

    <div class="form-group">        
        <label>Difficulty</label>
        <select class="custom-select" name="difficulty">
            <option value="1">Very Easy</option>
            <option value="2">Easy</option>
            <option value="3" selected>Somewhat Easy</option>
            <option value="4">Somewhat Hard</option>
            <option value="5">Hard</option>
            <option value="6">Very Hard</option>
        </select>
    </div>

    <div class="form-group">
        <label>Urgency</label>
        <div>
            <input type="radio" name="urgency" value="1">
            <label>Not Urgent</label>
        </div>
        <div>
            <input type="radio" name="urgency" value="2" checked>
            <label>Somewhat Urgent</label>
        </div>
        <div>
            <input type="radio" name="urgency" value="3">
            <label>Very Urgent</label>
        </div>
    </div>

    <div class="form-group">
        <label>Reward</label>
        <input type="number" name="reward">
    </div>

    <div class="form-group">
        <label>Address</label>
        <input type="text" name="address">
    </div>

    <div class="d-flex">
        <input type="submit" value="Add New Quest">
        <a class='ml-auto' href="<?=site_url()?>/neighbors_quests/myquests">Cancel</a>
    </div>
</form>

<a class="questaddsuccess" href="<?=site_url()?>/neighbors_quests/myquests" hidden></a>

<script src="<?=base_url()?>assets/js/newquest.js"></script>