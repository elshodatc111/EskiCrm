<?php
    include("../confige/confige.php");
    include("../confige/topHeader2.php");

    $Xona = $_GET['q'];
    $Start = $_GET['d1']." 00:00:00";
    $End = $_GET['d2']." 23:59:59";
    $date = array("Dushanba","Seshanba","Chorshanba","Payshanba","Juma","Shanba");
    $time_start = array("08:00-09:30","09:30-11:00","11:00-12:30","12:30-14:00","14:00-15:30","15:30-17:00","17:00-18:30","18:30-20:00","20:00-21:30");
?>
<div class="row">
    <?php
        if($End>$Start){
            foreach ($date as $Xafta) {?>
                <div class='col-lg-4'>
                    <label class='input-label'><?php echo $Xafta; ?></label>
                    <select name="<?php echo $Xafta; ?>" class='form-control select_form'>
                        <option value=''>Tanlang</option>
                        <?php
                            foreach ($time_start as $soat) {
                                $sql = "SELECT * FROM `xona_vaqt` WHERE `Xona`='".$Xona."' AND `Xafta`='".$Xafta."' AND `Soat`='".$soat."' AND `End`>='".$Start."'";
                                $res = $Confige->SelectAll($sql);
                                if($res->num_rows>0){}
                                else{
                                    echo "<option value=".$soat.">".$soat."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
            <?php }?>
            <div class="col-lg-12">
                <button type="submit" name="GuruhPlus" class="Filter_btn btn">Yangi guruhni saqlash</button>
            </div>
    <?php } ?>
</div>


																	
																
				