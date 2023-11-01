<?php
    $q = $_GET['q'];
?>
<div class="row">
    <?php
        if($q==='tashriflar'){
    ?>
    <div class="col-lg-12">
        <label>Tashriflarni tanlang</label>
        <select name="talabahaqida" class="form-control" required>
            <option value="">Tanlang</option>
            <option value="all">Barcha tashriflar</option>
            <option value="mavjudGuruhStudent">Guruhi mavjud bo'lgan tashriflar</option>
            <option value="mavjudEmasGuruhStudent">Guruhi mavjud bo'lmagan tashriflar</option>
        </select>
    </div>
    <?php
        }elseif($q === 'oqituvchilar'){
    ?>
        <div class="col-lg-12">
            <label>O'qituvchilarni tanlang</label>
            <select name="techershaqida" class="form-control" required>
                <option value="">Tanlang</option>
                <option value="all">Barcha o'qituvchilar</option>
                <option value="pays">O'qituvchilarga to'langan ish haqi</option>
                <option value="activ">Guruhga biriktirilgan o'qituvchilar</option>
            </select>
        </div>
    <?php
        }elseif($q === 'moliya'){
    ?>
        <div class="col-lg-12">
            <label>Tanlang</label>
            <select name="moliya" class="form-control" required>
                <option value="">Tanlang</option>
                <option value="studenttulov">Talabalar to'lovlari</option>
                <option value="guruhtulov">Talabalar guruhlarga to'lovlari </option>
                <option value="ortiqchatulov">Talabalar guruhlarga ortiqcha to'lovlar </option>
                <option value="qarzdortalabalar">Qarzdor talabalar </option>
                <option value="chiqimlar">Jami chiqimlar tarixi</option>
                <option value="hodimtulov">Hodimlar to'langan ish haqi</option>
            </select>
        </div>
    <?php
        }
    ?>
  
</div>
