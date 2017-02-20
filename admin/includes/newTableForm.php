<div class="col-md-12 box" style="padding-bottom: 20px;">
<form action="functions/adminActionsProccessing.php" method="GET" name="newTableForm">
    <div class="form-group">
        <div class="col-md-4">
        <label for="text">Table ID:<em style="color:red;"> *</em></label>
        <input type="text" name="id" class="form-control" placeholder="eg. A9" required>
        </div><div class="col-md-4">
        <label for="text">Table Size:<em style="color:red;"> *</em></label>
        <input type="number" name="size" class="form-control" placeholder="eg. 4" required>
        </div><div class="col-md-4">
            <div class="col-md-12">
                <label for="text">Smoking Area?</label></div>
        <input type="radio" name="smoking" value="0" checked> No 
        <input type="radio" name="smoking" value="1"> Yes
        </div><div class="col-md-12 centered" style="padding-top: 20px;">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="source" value="tables">
        <button type="submit" class="btn btn-success">Add table</button>
        </div>
    </div>

    
</form>
</div>
