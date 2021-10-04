<?php 
    $safePrefix = "";
    if(isset($idPrefix)){
        $safePrefix = $idPrefix;
    }
?>

<div class="modal-body">
    <form class="form-floating">

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" placeholder="name@example.com"
                id="<?php echo $safePrefix; ?>name">
            <label for="floatingInput">User's Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="<?php echo $safePrefix; ?>surname" name="surname"
                placeholder="Surname">
            <label for="floatingPassword">Surname</label>
        </div>
        <div class="mb-2">
            <label for="">Birthday (min 1971)</label>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="dd" aria-label="Day" name="dd"
                id="<?php echo $safePrefix; ?>dd">
            <span class="input-group-text">/</span>
            <input type="text" class="form-control" placeholder="mm" aria-label="Month" name="mm"
                id="<?php echo $safePrefix; ?>mm">
            <span class="input-group-text">/</span>
            <input type="text" class="form-control" placeholder="yyyy" aria-label="Year" name="yyyy"
                id="<?php echo $safePrefix; ?>yyyy">
        </div>
    </form>
</div>